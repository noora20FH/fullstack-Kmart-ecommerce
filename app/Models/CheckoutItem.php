<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
