<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['category'] ?? false) {
            $query->where('category', 'like', '%' . request('category') . '%');
        };
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('category', 'like', '%' . request('search') . '%');
        };
    }

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'stock',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'orderId', 'productId')->withPivot('quantity');
    }
}
