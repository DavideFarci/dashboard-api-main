<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\Date;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ReservationController extends Controller
{


    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(15);
        $dates = Date::all();
        return view('admin.reservations.index', compact('reservations', 'dates'));
    }


    public function show($id)
    {
        $dates = Date::all();
        $reservation = Reservation::where('id', $id)->firstOrFail();
        return view('admin.reservations.show', compact('reservation', 'dates'));
    }

    public function confirmReservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation && $reservation->status !== 1) {

            if ($reservation->status == 2) {
                $reservation->status = 1;
                $reservation->save();
                $date = Date::where('date_slot', $reservation->date_slot)->first();
                $date->reserved += $reservation->n_person;
                $date->save();
                return redirect("https://wa.me/" . '39' . $reservation->phone . "?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!");
            } else {
                $reservation->status = 1;
                $reservation->save();
                return redirect("https://wa.me/" . '39' . $reservation->phone . "?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!");
            }
        } else {
            return redirect()->back();
        }
    }

    public function rejectReservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation && $reservation->status !== 2) {
            $reservation->status = 2;
            $reservation->save();
            $date = Date::where('date_slot', $reservation->date_slot)->first();
            $date->reserved -= $reservation->n_person;
            $date->save();
            return redirect("https://wa.me/" . '39' . $reservation->phone . "?text=E' con profondo rammarico che siamo obbligati a disdire la vostra prenotazione!");
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

        return view('admin.reservations.create', compact('dates'));
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

        $newReserv = new Reservation();
        $newReserv->name = $data['name'];
        $newReserv->phone = $data['phone'];
        if ($data['email']) {
            $newReserv->email = $data['email'];
        } else {
            $newReserv = 'email@example.com';
        }
        $newReserv->n_person = intval($data['n_person']);
        $newReserv->message = $data['message'];
        $newReserv->status = 0;

        // recupero data e orario in questione 
        $date = Date::where('id', $data['date_id'])->firstOrFail();
        $newReserv->date_slot = $date->date_slot;

        $maximum = $date->reserved + $newReserv->n_person;

        if (isset($data['max_check'])) {
            $date->reserved = $date->reserved + $newReserv->n_person;
        } else {
            if ($maximum <= $date->max_res) {
                $date->reserved = $date->reserved + $newReserv->n_person;
                if ($date->reserved >= $date->max_res) {
                    $date->visible = 0;
                }
            } else {
                return redirect()->route('admin.reservations.create')->with(['max_res_check' => true, 'inputValues' => $data]);
            }
        }

        // Salvo la data e la prenotazione
        $date->save();
        $newReserv->save();

        return redirect()->route('admin.reservations.create')->with('reserv_success', true);
    }
}
