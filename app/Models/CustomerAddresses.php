<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddresses extends Model
{
  
    protected $table = 'customer_addresses'; // Specify the correct table name


   protected $fillable= ['user_id','first_name', 'last_name','email','mobile','country_id','address', 'notes'];
}
