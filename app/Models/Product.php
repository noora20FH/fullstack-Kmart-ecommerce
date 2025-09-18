<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'group',
        'product_category_id',
        'price',
        'stock',
        'image',
        'description',
        'isNew',
        'click_count',
    ];
    /**
     * Dapatkan pesanan (order) yang memiliki item pesanan ini.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
