<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ShipmentController extends Controller
{
    public function index(){
        $orders = Order::all();

        // Return view with data
        return view('shipment.index', compact('orders'));
    }

    public function markAsDelivered($id)
    {
        $order = Order::findOrFail($id);
        $order->shipment_status = 'delivered'; 
        $order->save();

        session()->flash('success', 'Order created successfully.');
        return redirect()->route('shipment.index');
    }
}
