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
        $orders = Order::orderBy('created_at', 'desc')->paginate(15);
        $orderProject = OrderProject::all();
        //dd($quantity_item );
        return view('admin.orders.index', compact('orders', 'orderProject'));
    }


    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $orderProject = OrderProject::all();
        return view('admin.orders.show', compact('order', 'orderProject'));
    }

    public function confirmOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = 1;
            $order->save();
        }
        return redirect("https://wa.me/" . $order->phone . '39' . "?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!");
    }

    public function rejectOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = 2;
            $order->save();
        }
        return redirect("https://wa.me/" . $order->phone . '39' . "?text=E' con profondo rammarico che siamo obbligati ad disdire la vostra prenotazione!");
    }
}
