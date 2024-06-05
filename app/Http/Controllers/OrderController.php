<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Inventory;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $inventoryData = Inventory::all();
        return view('orders.create', compact('inventoryData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'order_units' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'total_amount' => 'nullable|numeric|min:0',
            'comment' => 'nullable|string',
            'status' => 'nullable|string',
            'product_code' => 'required|numeric|min:0',
        ]);

        // Retrieve product code and order units from the request
        $productCode = $request->input('product_code');
        $orderUnits = $request->input('order_units');

        // Retrieve inventory item based on product code
        $inventoryItem = Inventory::where('product_code', $productCode)->first();

        if (!$inventoryItem) {
            return back()->withInput()->withErrors(['product_code' => 'Inventory item not found for given product code']);
        }

        // Calculate total amount
        $price = $inventoryItem->price;
        $totalAmount = $price * $orderUnits;

        // Create new order
        $order = new Order([
            'product_name' => $request->input('product_name'),
            'customer_name' => $request->input('customer_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'order_units' => $orderUnits,
            'order_date' => $request->input('order_date'),
            'product_code' => $productCode,
            'total_amount' => $totalAmount,
            'comment' => $request->input('comment'),
            'status' => $request->input('status'),
        ]);

        $order->save();

        // Flash success message and redirect
        session()->flash('success', 'Order created successfully.');
        return redirect()->route('orders.index');
    }


public function createOrder()
{
    $inventoryData = Inventory::all();
    return view('orders.index', compact('inventoryData'));
}


}
