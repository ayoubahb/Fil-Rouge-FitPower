<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'city',
        'postal_code',
        'phone',
        'payment_type',
        'payment_status',
        'order_status',
        'total',
        'userId'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'orderId', 'productId');
    }
}
