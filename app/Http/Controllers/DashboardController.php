<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Inventory::count();
        $totalStocks = Inventory::sum('stocks');
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');

        $monthlyOrders = Order::selectRaw('MONTH(order_date) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard.dashboard', compact(
            'totalProducts',
            'totalStocks',
            'totalOrders',
            'totalRevenue',
            'monthlyOrders'
        ));
    }
}