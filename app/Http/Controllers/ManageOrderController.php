<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class ManageOrderController extends Controller
{

    public function index()
    {
        // Fetch orders or any other logic here
        $orders = Order::all();

        // Return view with data
        return view('manage.index', compact('orders'));
    }

    // Other methods like update, store, delete, etc.

    public function approve(Order $order)
    {
        $order->status = 'APPROVED';
        $order->save();

        session()->flash('success', 'Order approved successfully.');
        return redirect()->route('manage.index');
    }

    public function disapprove(Order $order)
    {
        $order->status = 'DISAPPROVED';
        $order->save();

        session()->flash('success', 'Order disapproved successfully.');
        return redirect()->route('manage.index');
    }
}
