<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProject;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   
    public function index()
    {
        $orders = Order::paginate(15);;
        $orderProject = OrderProject::all();
        //dd($quantity_item );
        return view('admin.orders.index', compact('orders', 'orderProject' ));
    }

    
    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $orderProject = OrderProject::all();
        return view('admin.orders.show', compact('order', 'orderProject' ));
    }

    
    public function updatestatus($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = !$order->status; // Inverte lo stato corrente
            $order->save();
        }
        return redirect()->back();
    }
}
