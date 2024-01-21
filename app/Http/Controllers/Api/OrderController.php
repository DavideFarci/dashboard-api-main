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
        // $arrId= json_decode($data['arrId']);
        // $arrQt= json_decode($data['arrQt']);
        //$arrVar= json_decode($data['arrVariation'], true);
        
        $arrvar1 = str_replace('\\', '', $data['arrVariation']);
        $arrvar2 = json_decode($arrvar1,true);
        //dd(json_decode($arrvar1,true));
        // dump($data['arrId']);
        // dump($data['arrQt']);
        // dump($arrQt);
        
        $cart=[];
        
        
        for($i = 0; $i < count($arrvar2); ++$i){
            $project = Project::where('id', $arrvar2[$i]['p_id'])->first();

            $total_price += $project->price *  $arrvar2[$i]['counter'];
        }
        
        for($i = 0; $i < count($arrvar2); ++$i){
            $newItem=[
                'id' => '',
                'qt' => '',
                'deselected' =>'',
            ];
            $newItem["id"] = $arrvar2[$i]['p_id'];
            $newItem["qt"] = $arrvar2[$i]['counter'];
            $newItem["deselected"] = $arrvar2[$i]['deselected'];
            array_push($cart, $newItem);
            
        }

   
        $newOrder = new Order();
        $newOrder->name          = $data['name'];
        $newOrder->phone         = $data['phone'];
        $newOrder->time          = $data['time'];
        $newOrder->date          = $data['date'];
        $newOrder->total_price   = $total_price;
        $newOrder->status        = 0;
        $arr_id = [];
        $newOrder->save();
        
        foreach ($cart as $elem) {
            $item_order = new OrderProject();
            $item_order->order_id = $newOrder->id;
            $item_order->project_id = $elem['id'];
            $item_order->quantity_item = $elem['qt'];
            $item_order->deselected= json_encode($elem['deselected']);
            $item_order->save();
            array_push($arr_id, $item_order->id );
        }
        // richiamo l'ordine che ho appena inserito (just do)
        $jdNewOrder= Order::where('id', $newOrder->id)->firstOrFail();
        //dd($jdNewOrder->id);
        $jdNewOrder->var_id = json_encode($arr_id);
        $jdNewOrder->update();

        // ritornare un valore di successo al frontend
        return response()->json([
            'success' => true,
        ]);

        // return response()->json($request->all()); // solo per debuggare
    }
}

// <?php

// namespace App\Http\Controllers\Api;

// use App\Models\Order;
// use App\Models\Project;
// use App\Models\OrderProject;
// use App\Models\projectOrder;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;

// class OrderController extends Controller
// {

//     // private $validations = [ // to do
//     //     'name'          => 'required|string|min:5|max:50',
//     //     'surname'          => 'required|string|min:5|max:50',
//     //     'phone'          => 'required|string|min:5|max:50',
//     //     'email'         => 'required|email|min:5|max:255',
//     //     'message'       => 'required|string',
//     //     'newsletter'    => 'required|boolean',
//     // ];

//     public function store(Request $request)
//     {

        

//         // salvare i dati del Order nel database
//         $total_price = 0;
//         $data = $request->all();

//         //$arrVar= json_decode($data['arrVariation'], true);
        
//         $arrvar1 = str_replace('\\', '', $data['arrVariation']);

//         $arrvar2 = json_decode($arrvar1,true);
     

//         //dd($arrvar1);
//         //dd($arrvar2);
//         // dump($data['arrId']);
//         // dump($data['arrQt']);
//         // dump($arrQt);
        
//         $cart=[];
        
        
//         for($i = 0; $i < count($arrvar2); ++$i){
//             $project = Project::where('id', $arrvar2[$i])->first();

//             $total_price += $project->price * $arrvar2[$i]['counter'];
//         }
        
//         for($i = 0; $i < count($arrvar2); ++$i){
//             $newItem=[
//                 'id' => '',
//                 'qt' => '',
//                 'deselected' =>'',
//             ];
//             $newItem["id"] = $arrvar2[$i]['p_id'];
//             $newItem["qt"] = $arrvar2[$i]['counter'];
//             if(count($arrvar2[$i]['deselected']) !== 0){

//                 $newItem["deselected"] = $arrvar2[$i]['deselected'];
//             }else{
                
//                 $newItem["deselected"] = [];
//             }
//             array_push($cart, $newItem);
            
//         }
//   //  dd($cart);

//         $newOrder = new Order();
//         $newOrder->name          = $data['name'];
//         $newOrder->phone         = $data['phone'];
//         $newOrder->time          = $data['time'];
//         $newOrder->date          = $data['date'];
//         $newOrder->total_price   = $total_price;
//         $newOrder->status        = 0;
//         $newOrder->save();

//         foreach ($cart as $elem) {
//             $item_order = new OrderProject();
//             $item_order->order_id = $newOrder->id;
//             $item_order->project_id = $elem['id'];
//             $item_order->quantity_item = $elem['qt'];
//             $item_order->deselected= json_encode($elem['deselected']) ;
//             $item_order->save();
//         }

//         // ritornare un valore di successo al frontend
//         return response()->json([
//             'success' => true,
//         ]);

//         // return response()->json($request->all()); // solo per debuggare
//     }
// }

