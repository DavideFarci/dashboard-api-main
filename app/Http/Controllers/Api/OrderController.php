<?php

namespace App\Http\Controllers\Api;

use App\Models\Date;
use App\Models\Order;
use App\Models\Project;
use App\Models\Category;
use App\Models\OrderProject;
use App\Models\projectOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    // private $validations = [ // to do
    //     'name'          => 'required|string|min:5|max:50',
    //     'surname'          => 'required|string|min:5|max:50',
    //     'phone'          => 'required|string|min:5|max:50',
    //     'email'         => 'required|email|min:5|max:255',
    //     'message'       => 'required|string',
    //     'newsletter'    => 'required|boolean',
    // ];

    public function store(Request $request)
    {
        // salvare i dati del Order nel database
        $total_price = 0;
        $data = $request->all();

        $arrvar = str_replace('\\', '', $data['arrVariation']);
        $arrvar2 = json_decode($arrvar, true);


        for ($i = 0; $i < count($arrvar2); ++$i) {
            $project = Project::where('id', $arrvar2[$i]['p_id'])->first();

            $total_price += $project->price *  $arrvar2[$i]['counter'];
        }

        $newOrder = new Order();
        $newOrder->name          = $data['name'];
        $newOrder->phone         = $data['phone'];
        $newOrder->time          = $data['time'];
        $newOrder->date          = $data['date'];
        $newOrder->total_price   = $total_price;
        $newOrder->status        = 0;
        $newOrder->save();

        $pezzi = 0;
        foreach ($arrvar2 as $elem) {
            $item_order = new OrderProject();
            $item_order->order_id = $newOrder->id;
            $item_order->project_id = $elem['p_id'];
            $item_order->quantity_item = $elem['counter'];
            $product = Project::where('id', $elem['p_id'])->first();
            $category = Category::where('id', $product->category_id)->first();
            if ($category->slot) {
                $pezzi = ($pezzi + $elem['counter']) * $category->slot;
            }
            $item_order->deselected = json_encode($elem['deselected']);
            $item_order->addicted = json_encode($elem['addicted']);
            $item_order->save();
        }

        $date = Date::where('id', $data['date_id'])->firstOrFail();
        $maximum = $date->reserved_pz + $pezzi;

        if ($maximum <= $date->max_pz) {
            $date->reserved_pz = $date->reserved_pz + $pezzi;
            if ($date->reserved_pz == $date->max_pz) {
                $date->visible = 0;
            }
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
        ]);

        // return response()->json($request->all()); // solo per debuggare
    }
}
