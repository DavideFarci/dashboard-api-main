<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Project;
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
        $arrId= json_decode($data['arrId']);
        $arrQt= json_decode($data['arrQt']);
        // dump($data['arrId']);
        // dump($data['arrQt']);
        // dump($arrQt);
        
        $cart=[];
        
        
        for($i = 0; $i < count($arrId); ++$i){
            $project = Project::where('id', $arrId[$i])->first();

            $total_price += $project->price * $arrQt[$i];
        }
        
        for($i = 0; $i <count($arrId); ++$i){
            $newItem=[
                'id' => '',
                'qt' => '',
            ];
            $newItem["id"] = $arrId[$i];
            $newItem["qt"] = $arrQt[$i];
            array_push($cart, $newItem);
            
        }
    //dd($cart);

        $newOrder = new Order();
        $newOrder->name          = $data['name'];
        $newOrder->phone         = $data['phone'];
        $newOrder->time          = $data['time'];
        $newOrder->date          = $data['date'];
        $newOrder->total_price   = $total_price;
        $newOrder->status        = 0;
        $newOrder->save();

        foreach ($cart as $elem) {
            $item_order = new OrderProject();
            $item_order->order_id = $newOrder->id;
            $item_order->project_id = $elem['id'];
            $item_order->quantity_item = $elem['qt'];
            $item_order->save();
        }

        // ritornare un valore di successo al frontend
        return response()->json([
            'success' => true,
        ]);

        // return response()->json($request->all()); // solo per debuggare
    }
}

