<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ManageOrderController;
use App\Http\Controllers\ShipmentController;

Route::get('/', function () {
    return view('dashboard/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {



    Route::get('/shipment', [ShipmentController::class, 'index'])->name('shipment.index');
    Route::post('/shipment/delivered/{id}', [ShipmentController::class, 'markAsDelivered'])->name('shipment.delivered');

    // FOR ORDER LIST APPROVAL
    Route::get('/manage', [ManageOrderController::class, 'index'])->name('manage.index');
    Route::put('/manage/{order}/update', [ManageOrderController::class, 'update'])->name('manage.update');

    
    Route::post('/manage/{order}/approve', [ManageOrderController::class, 'approve'])->name('manage.approve');
    Route::post('/manage/{order}/disapprove', [ManageOrderController::class, 'disapprove'])->name('manage.disapprove');
     
     // Route for displaying the list of orders
     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
     
     // Route for showing the order creation form
     Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

     Route::get('/orders', [OrderController::class, 'createOrder'])->name('orders.index');

     
     // Route for storing a new order
     Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

    //  Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::put('/inventory/{inventory}/update', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{inventory}/delete', [InventoryController::class, 'destroy'])->name('inventory.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
