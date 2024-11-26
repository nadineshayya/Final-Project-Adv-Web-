<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    protected $fillable = [
        'order_id', // Add this to allow mass assignment
        'product_id',
        'name',
        'qty',
        'price',
        'total',
    ];
}
