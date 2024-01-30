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
    private $validations = [
        'name'      => 'required|string|max:50',
        'phone'     => 'required|string|max:20',
        'n_person'  => 'required|string|max:10',
        'message'   => 'nullable|string|max:1000',
        'date_slot' => 'required|string|size:16',
    ];

    public function store(Request $request)
    {
        try {
            $request->validate($this->validations);

            $data = $request->all();

            $newOrder = new Reservation();
            $newOrder->name = $data['name'];
            $newOrder->phone = $data['phone'];
            $newOrder->n_person = intval($data['n_person']);
            $newOrder->message = $data['message'];
            $newOrder->status = 0;
            $newOrder->date_slot = $data['date_slot'];

            // recupero data e orario in questione 
            $date = Date::where('id', $data['date_id'])->firstOrFail();

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


            //invia mail

            // Salvo la data e la prenotazione
            $date->save();
            $newOrder->save();

            return response()->json([
                'success' => true,
                "prenotazione" => $newOrder,
                // "reserved" => $date->reserved,
                "data" => $date
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
