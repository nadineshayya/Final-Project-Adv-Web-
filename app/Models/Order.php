<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'subtotal', 'shipping', 'coupon_code', 'discount', 'grand_total', 
        'first_name', 'last_name', 'email', 'mobile', 'country_id', 'address', 'notes',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
  
}
