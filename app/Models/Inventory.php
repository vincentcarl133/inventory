<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = ['name', 'stocks', 'price', 'description', 'product_code'];

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'product_code', 'product_code');
    }
}
