<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory; // Ensure this line is present
use Illuminate\Database\Eloquent\Model;
class category extends Model
{
    use HasFactory;
    

    protected $fillable = ['name', 'slug', 'image', 'status'];

}
