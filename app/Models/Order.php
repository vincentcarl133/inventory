<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'customer_name',
        'phone_number',
        'address',
        'order_units',
        'order_date',
        'total_amount',
        'comment',
        'status',
        'product_code'
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'product_code', 'product_code');
    }
}
