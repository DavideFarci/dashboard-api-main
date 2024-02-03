<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Date;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Database\Seeders\DatesTableSeeder;

class DateController extends Controller
{
    public function index()
    {
        $dates = Date::paginate(100);

        return view('admin.dates.index', compact('dates'));
    }

    public function updatestatus($date_id)
    {
        $date = Date::find($date_id);
        if ($date) {
            $date->visible = !$date->visible; // Inverte lo stato corrente
            $date->save();
        }
        return redirect()->back();
    }

    public function upmaxres($date_id)
    {
        $date = Date::find($date_id);
        $date->max_res++;
        $date->save();

        return redirect()->back();
    }

    public function downmaxres($date_id)
    {
        $date = Date::find($date_id);
        if ($date->max_res > 0) {

            $date->max_res--;
            $date->save();
        }

        return redirect()->back();
    }
    public function upmaxpz($date_id)
    {
        $date = Date::find($date_id);
        $date->max_pz++;
        $date->save();

        return redirect()->back();
    }

    public function downmaxpz($date_id)
    {
        $date = Date::find($date_id);
        if ($date->max_pz > 0) {

            $date->max_pz--;
            $date->save();
        }

        return redirect()->back();
    }

    private $validations = [
        'max_reservations'      => 'required|integer',
        'max_pz'                => 'required|integer',
        'times_slot_1'          => 'array',
        'times_slot_1.*'        => 'string',
        'times_slot_2'          => 'array',
        'times_slot_2.*'        => 'string',
        'times_slot_3'          => 'array',
        'times_slot_3.*'        => 'string',
        'times_slot_4'          => 'array',
        'times_slot_4.*'        => 'string',
        'times_slot_5'          => 'array',
        'times_slot_5.*'        => 'string',
        'times_slot_6'          => 'array',
        'times_slot_6.*'        => 'string',
        'times_slot_7'          => 'array',
        'times_slot_7.*'        => 'string',
    ];

    public function runSeeder(Request $request)
    {
        try {
            $request->validate($this->validations);
            $max_reservations = $request->input("max_reservations");
            $max_pz = $request->input("max_pz");
            $days_off = $request->input("days_off");
            $times_slot1 = $request->input("times_slot_1");
            $times_slot2 = $request->input("times_slot_2");
            $times_slot3 = $request->input("times_slot_3");
            $times_slot4 = $request->input("times_slot_4");
            $times_slot5 = $request->input("times_slot_5");
            $times_slot6 = $request->input("times_slot_6");
            $times_slot7 = $request->input("times_slot_7");

            $timesDay = [
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
                [
                    ['time' => '19:00', 'set' => ''],
                    ['time' => '19:30', 'set' => ''],
                    ['time' => '20:00', 'set' => ''],
                    ['time' => '20:30', 'set' => ''],
                    ['time' => '21:00', 'set' => ''],
                    ['time' => '21:30', 'set' => ''],
                ],
            ];


            for ($i = 0; $i < count($timesDay[0]); $i++) {
                $timesDay[0][$i]['set'] = $times_slot1[$i];
            }
            for ($i = 0; $i < count($timesDay[1]); $i++) {
                $timesDay[1][$i]['set'] = $times_slot2[$i];
            }
            for ($i = 0; $i < count($timesDay[2]); $i++) {
                $timesDay[2][$i]['set'] = $times_slot3[$i];
            }
            for ($i = 0; $i < count($timesDay[3]); $i++) {
                $timesDay[3][$i]['set'] = $times_slot4[$i];
            }
            for ($i = 0; $i < count($timesDay[4]); $i++) {
                $timesDay[4][$i]['set'] = $times_slot5[$i];
            }
            for ($i = 0; $i < count($timesDay[5]); $i++) {
                $timesDay[5][$i]['set'] = $times_slot6[$i];
            }
            for ($i = 0; $i < count($timesDay[6]); $i++) {
                $timesDay[6][$i]['set'] = $times_slot7[$i];
            }

            //dd($timesDay);
            // @dd("max_reservations: " . $max_reservations, "times_slot: " . $timesDay_slot, "days_off: " . $days_off);
            // dump($timesDay);

            // Pulisco le tabelle
            DB::table('dates')->truncate();
            DB::table('months')->truncate();
            DB::table('days')->truncate();

            // Eseguo il seeder
            $seeder = new DatesTableSeeder();
            $seeder->setVariables($max_reservations, $max_pz, $timesDay, $days_off);
            $seeder->run();

            // Ripristino le prenotazioni
            $this->restoreReservationsAndOrders();

            return back()->with('success', 'Seeder avvenuto con successo')->with('response', [
                'success' => true,
                'message'  => 'Seeder avvenuto con successo',
            ]);
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $errorInfo = [
                'success' => false,
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage(),
                'file' => $trace[0]['file'],
                'line' => $trace[0]['line'],
            ];

            return response()->json($errorInfo, 500);
        }
    }

    public function restoreReservationsAndOrders()
    {
        $reservations = Reservation::all();

        if ($reservations) {
            foreach ($reservations as $reservation) {
                $date = Date::where('date_slot', $reservation->date_slot)->first();
                if ($date) {
                    $date->reserved = $date->reserved + $reservation->n_person;
                    $date->save();
                }
            }
        }

        $orders = Order::all();

        if ($orders) {
            foreach ($orders as $order) {
                $date = Date::where('date_slot', $order->date_slot)->first();
                if ($date) {
                    $date->reserved_pz = $date->reserved_pz + $order->total_pz;
                    $date->save();
                }
            }
        }
    }
}
