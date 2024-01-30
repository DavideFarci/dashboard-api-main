<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Date;
use App\Models\Order;
use App\Models\Project;
use App\Models\Category;
use App\Models\OrderProject;
use App\Models\projectOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    private $validations = [
        'name'          => 'required|string|min:5|max:50',
        'phone'         => 'required|string|min:5|max:20',
        'email'         => 'required|email|max:100',
        'message'       => 'nullable|string|min:5|max:1000',
        'date_slot'     => 'required|string|size:16',
    ];

    public function store(Request $request)
    {
        $request->validate($this->validations);
        // salvare i dati del Order nel database
        $total_price = 0;
        $data = $request->all();

        $arrvar = str_replace('\\', '', $data['products']);
        $arrvar2 = json_decode($arrvar, true);
        $total_pz = 0;


        try {
            for ($i = 0; $i < count($arrvar2); ++$i) {
                // Calcolo il numero di pezzi ordinati in base alla categoria
                $project = Project::where('id', $arrvar2[$i]['p_id'])->first();
                $category = Category::where('id', $project->category_id)->first();
                if ($category->slot) {
                    $total_pz += ($arrvar2[$i]['counter'] * $category->slot);
                }

                // Calcolo il prezzo totale (senza aggiunte)
                $total_price += $project->price *  $arrvar2[$i]['counter'];
            }

            // Considero le aggiunte nel prezzo totale
            for ($i = 0; $i < count($arrvar2); ++$i) {
                for ($z = 0; $z < count($arrvar2[$i]['addicted']); $z++) {
                    $ingredient = Tag::where('name', $arrvar2[$i]['addicted'][$z])->first();
                    $total_price += $ingredient->price * $arrvar2[$z]['counter'];
                }
            }

            $newOrder = new Order();
            $newOrder->name          = $data['name'];
            $newOrder->phone         = $data['phone'];
            $newOrder->email         = $data['email'];
            $newOrder->message       = $data['message'];
            $newOrder->date_slot     = $data['date_slot'];
            $newOrder->total_price   = $total_price;
            $newOrder->total_pz      = $total_pz;
            $newOrder->status        = 0;
            $newOrder->save();

            foreach ($arrvar2 as $elem) {
                $item_order = new OrderProject();
                $item_order->order_id = $newOrder->id;
                $item_order->project_id = $elem['p_id'];
                $item_order->quantity_item = $elem['counter'];
                $item_order->deselected = json_encode($elem['deselected']);
                $item_order->addicted = json_encode($elem['addicted']);
                $item_order->save();
            }

            $date = Date::where('id', $data['date_id'])->firstOrFail();
            $maximum = $date->reserved_pz + $total_pz;

            if ($maximum <= $date->max_pz) {
                $date->reserved_pz += $total_pz;
                if ($date->reserved_pz == $date->max_pz) {
                    $date->visible = 0;
                }
                $date->save();
            } else {
                // se non ci sono più posti rispondo picche
                return response()->json([
                    'success' => false,
                    'message' => 'Il numero massimo di pezzi per questa data e orario è già stato raggiunto',
                ]);
            }
            // ritornare un valore di successo al frontend
            return response()->json([
                'success' => true,
                'order' => $newOrder
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore del database: ' . $e->getMessage(),
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

        // return response()->json($request->all()); // solo per debuggare
    }
}
