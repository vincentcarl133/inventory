<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::all();
        return view('inventory.index', compact('inventory'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'stocks' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'product_code' => 'required|numeric|min:0',
        ]);

        Inventory::create($request->all());

            session()->flash('success', 'Inventory item created successfully.');

            return redirect()->route('inventory.index');
    }



    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string',
            'stocks' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $inventory->update($request->all());

        session()->flash('success', 'Inventory item updated successfully.');

        return redirect()->route('inventory.index');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        session()->flash('success', 'Inventory item deleted successfully.');

        return redirect()->route('inventory.index');
    }
}
