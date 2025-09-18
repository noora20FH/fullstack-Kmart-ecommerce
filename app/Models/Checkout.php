<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping_cost',
        'tax_amount',
        'total_amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CheckoutItem::class);
    }
    public function checkoutItems()
    {
        return $this->hasMany(CheckoutItem::class);
    }
}
