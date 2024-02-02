<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Date;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DateController extends Controller
{
    public function index()
    {
        try {
            // Formatto la data e l'ora correnti in formato italiano
            $dataOraFormattate = Carbon::now()->format('d-m-Y H:i:s');

            // Dalla data formattata (stringa) ottengo un oggetto sul quale posso operare
            $dataOraCarbon = Carbon::createFromFormat('d-m-Y H:i:s', $dataOraFormattate)->addDay();

            // Calcolo la data di inizio considerando il giorno successivo a oggi
            $dataInizio = $dataOraCarbon->copy()->startOfDay();

            // Calcolo la data di fine considerando due mesi successivi alla data odierna
            $dataDiFineParz = $dataInizio->copy()->startOfMonth();
            $dataFine = $dataDiFineParz->copy()->addMonths(2)->endOfMonth();


            // Filtro dal giorno successivo a oggi e per i due mesi successivi
            $dates = Date::where('year', '>=', $dataInizio->year)
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

            return response()->json([
                'success' => true,
                "data_e_ora_attuali" => $dataOraFormattate,
                // "fineParziale" => $dataDiFineParz->day,
                "dataDiInizio" => $dataInizio->day . "/" . $dataInizio->month . "/" . $dataInizio->year,
                "dataDiFine" => $dataFine->day . "/" . $dataFine->month . "/" . $dataFine->year,
                'results' => $dates,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore del database: ' . $e->getMessage(),
            ]);
        } catch (Exception $e) {
            // Eccezioni generiche, stampo il messaggio restituito
            return response()->json([
                'success' => false,
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage(),
            ], 500);
        }
    }

    private $validations = [
        'year'  => 'required|integer|between:2023,2050',
        'month' => 'required|integer|between:1,12',
        'day'   => 'required|integer|between:1,31',
        'time'  => 'required|string|size:5',
    ];

    // restituisce una data in formato originale in base alla richiesta di prenotazione tavolo
    public function findDate(Request $request)
    {
        try {
            $request->validate($this->validations);

            $year = $request->input("year");
            $month = $request->input("month");
            $day = $request->input("day");
            $time = $request->input("time");

            $date = Date::where('year', $year)
                ->where('month', $month)
                ->where('day', $day)
                ->where('time', $time)
                ->get();
            if (!$date) {
                return response()->json([
                    'success' => false,
                    'message' => "Data non trovata",
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'results' => $date,
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore del database: ' . $e->getMessage(),
            ]);
        } catch (Exception $e) {
            // Eccezioni generiche, stampo il messaggio restituito
            return response()->json([
                'success' => false,
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage(),
            ], 500);
        }
    }
}
