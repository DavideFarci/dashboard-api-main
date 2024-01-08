<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Date;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\QueryException;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $newOrder = new Reservation();
            $newOrder->name = $data['name'];
            $newOrder->phone = $data['phone'];
            $newOrder->n_person = intval($data['n_person']);
            $newOrder->message = $data['message'];
            $newOrder->status = 0;
            $newOrder->date_id = $data['date_id'];

            // recupero data e orario in questione 
            $date = Date::where('id', $newOrder->date_id)->firstOrFail();

            $maximum = $date->reserved + $newOrder->n_person;

            if ($maximum <= $date->max_res) {
                $date->reserved = $date->reserved + $newOrder->n_person;
                if ($date->reserved == $date->max_res) {
                    $date->visible = 0;
                }
            } else {
                // se non ci sono più posti rispondo picche
                return response()->json([
                    'success' => false,
                    'message' => 'Il numero massimo di prenotazioni per questa data e orario è già stato raggiunto',
                ]);
            }

            // Salvo la data
            $date->save();

            return response()->json([
                'success' => true,
                "prenotazione" => $newOrder,
                // "reserved" => $date->reserved,
                // "data" => $date
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore del database: ' . $e->getMessage(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Si è verificato un errore: ' . $e->getMessage(),
            ]);
        }
    }
}
