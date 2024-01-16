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
        try {
            $max_reservations = $request->input("max_reservations");
            $times_slot = $request->input("times_slot");
            $days_off = $request->input("days_off");

            // @dd("max_reservations: " . $max_reservations, "times_slot: " . $times_slot, "days_off: " . $days_off);

            // Pulisco la tabella
            DB::table('dates')->truncate();
            DB::table('months')->truncate();
            DB::table('days')->truncate();

            $seeder = new DatesTableSeeder();
            $seeder->setVariables($max_reservations, $times_slot, $days_off);
            $seeder->run();

            $reservations = Reservation::all();
            foreach($reservations as $reservation){
               dump($reservation->date_slot);
               $dataCorrispondente = Date::where('date_slot', $reservation->date_slot);
               dump($dataCorrispondente->day);
               if($dataCorrispondente){

                $dataCorrispondente->reserved += $reservation->n_person;
                $dataCorrispondente->update();
               }
            }
            


            return back()->with('success', 'Seeder avvenuto con successo')->with('response', [
                'success' => true,
                'message' => 'Seeder avvenuto con successo',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Si e verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage(),
            ], 500);
        }
    }
}
