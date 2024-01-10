<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Date;
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

        @dump($dates[14]);

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

            // @dump("max_reservations: " . $max_reservations, "times_slot: " . $times_slot, "days_off: " . $days_off);
            // @dd("max_reservations: " . $max_reservations, "times_slot: " . $times_slot, "days_off: " . $days_off);

            // Pulisco la tabella
            DB::table('dates')->truncate();

            $seeder = new DatesTableSeeder();
            $seeder->setVariables($max_reservations, $times_slot, $days_off);
            $seeder->run();

            return response()->json([
                'success' => true,
                'message' => 'Seeder avvenuto con successo',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage(),
            ], 500);
        }
    }
}
