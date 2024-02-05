<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\Date;
use App\Models\Order;
use App\Models\OrderProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(15);
        $orderProject = OrderProject::all();
        //dd($quantity_item );
        return view('admin.orders.index', compact('orders', 'orderProject'));
    }


    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $orderProject = OrderProject::all();
        return view('admin.orders.show', compact('order', 'orderProject'));
    }

    public function confirmOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order && $order->status !== 1) {
            if ($order->status == 2) {
                $order->status = 1;
                $order->save();
                $date = Date::where('date_slot', $order->date_slot)->first();
                $date->reserved_pz += $order->total_pz;
                $date->save();
                return redirect("https://wa.me/" . $order->phone . '39' . "?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!");
            } else {
                $order->status = 1;
                $order->save();
                return redirect("https://wa.me/" . $order->phone . '39' . "?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!");
            }
        } else {
            return redirect()->back();
        }
    }

    public function rejectOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order && $order->status !== 2) {
            $order->status = 2;
            $order->save();
            $date = Date::where('date_slot', $order->date_slot)->first();
            $date->reserved_pz -= $order->total_pz;
            $date->save();

            return redirect("https://wa.me/" . $order->phone . '39' . "?text=E' con profondo rammarico che siamo obbligati ad disdire la vostra prenotazione!");
        } else {
            return redirect()->back();
        }
    }

    public function create()
    {
        // Formatto la data e l'ora correnti in formato italiano
        $dataOraFormattate = Carbon::now()->format('d-m-Y H:i:s');

        // Dalla data formattata (stringa) ottengo un oggetto sul quale posso operare
        $dataOraCarbon = Carbon::createFromFormat('d-m-Y H:i:s', $dataOraFormattate)->addDay();

        // Calcolo la data di inizio considerando il giorno successivo a oggi
        $dataInizio = $dataOraCarbon->copy()->startOfDay();

        // Calcolo la data di fine considerando due mesi successivi alla data odierna
        $dataDiFineParz = $dataInizio->copy()->startOfMonth();
        $dataFine = $dataDiFineParz->copy()->addMonths(1)->endOfMonth();


        // Filtro dal giorno successivo a oggi e per i due mesi successivi
        $dates = Date::where('visible', '=', 1)
            ->where('year', '>=', $dataInizio->year)
            ->where('month', '>=', $dataInizio->month)
            ->where(function ($query) use ($dataInizio) {
                $query->where('month', '>', $dataInizio->month)
                    ->orWhere(function ($query) use ($dataInizio) {
                        $query->where('month', '=', $dataInizio->month)
                            ->where('day', '>=', $dataInizio->day);
                    });
            })
            ->where('year', '<=', $dataFine->year)
            ->where('month', '<=', $dataFine->month)
            ->get();

        return view('admin.orders.create', compact('dates'));
    }

    private $validations = [
        'name'          => 'required|string|min:5|max:50',
        'phone'         => 'required|integer',
        'email'         => 'email|max:100',
        'message'       => 'nullable|string|min:5|max:1000',
        'date_id'       => 'required',
    ];
    public function store(Request $request)
    {
        $request->validate($this->validations);
        $data = $request->all();

        $newOrder = new Order();
        $newOrder->name          = $data['name'];
        $newOrder->phone         = $data['phone'];
        if ($data['email']) {
            $newOrder->email         = $data['email'];
        } else {
            $newOrder->email = 'email@example.com';
        }
        $newOrder->total_price   = $data['total_price'] * 100;
        $newOrder->total_pz      = $data['total_pz'];
        $newOrder->message       = $data['message'];
        $newOrder->status        = 0;

        $date = Date::where('id', $data['date_id'])->firstOrFail();
        $newOrder->date_slot = $date->date_slot;

        $maximum = $date->reserved_pz + $newOrder->total_pz;

        if (isset($data['max_check'])) {
            $date->reserved_pz = $date->reserved_pz + $newOrder->total_pz;
        } else {
            if ($maximum <= $date->max_res) {
                $date->reserved_pz = $date->reserved_pz + $newOrder->total_pz;
                if ($date->reserved_pz >= $date->max_res) {
                    $date->visible = 0;
                }
            } else {
                return redirect()->route('admin.orders.create')->with(['max_res_check' => true, 'inputValues' => $data]);
            }
        }

        // dd("date: " . $date, "order: " . $newOrder);
        $date->save();
        $newOrder->save();

        return redirect()->route('admin.orders.create')->with('reserv_success', true);
    }
}
