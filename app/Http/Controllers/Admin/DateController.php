<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Date;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Database\Seeders\DatesTableSeeder;
use Illuminate\Support\Facades\Artisan;

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

    public function runSeeder(Request $request)
    {
        //dd($request->input("times_slot"));

        try {
            $max_reservations = $request->input("max_reservations");
            $max_pz = $request->input("max_pz");
            $days_off = $request->input("days_off");
            $times_slot = $request->input("times_slot");
            // dump($times_slot);
            $times = [
                ['time' => '19:00', 'set' => ''],
                ['time' => '19:30', 'set' => ''],
                ['time' => '20:00', 'set' => ''],
                ['time' => '20:30', 'set' => ''],
                ['time' => '21:00', 'set' => ''],
                ['time' => '21:30', 'set' => ''],
            ];
            for ($i = 0; $i < count($times); $i++) {
                $times[$i]['set'] = $times_slot[$i];
            }

            // @dd("max_reservations: " . $max_reservations, "times_slot: " . $times_slot, "days_off: " . $days_off);
            // dump($times);

            // Pulisco le tabelle
            DB::table('dates')->truncate();
            DB::table('months')->truncate();
            DB::table('days')->truncate();

            // Eseguo il seeder
            $seeder = new DatesTableSeeder();
            $seeder->setVariables($max_reservations, $max_pz, $times, $days_off);
            $seeder->run();

            // Ripristino le prenotazioni
            $this->restoreReservations();

            return back()->with('success', 'Seeder avvenuto con successo')->with('response', [
                'success' => true,
                'message' => 'Seeder avvenuto con successo',
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

    public function restoreReservations()
    {
        $reservations = Reservation::where(DB::raw("STR_TO_DATE(date_slot, '%d/%m/%Y %H:%i')"), '>', DB::raw('NOW()'))->get();
        // dd($reservations);

        foreach ($reservations as $reservation) {
            $date = Date::where('date_slot', $reservation->date_slot)->first();
            $date->reserved = $date->reserved + $reservation->n_person;
            $date->save();
        }
    }
}
