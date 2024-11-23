<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
 use HasFactory;

 public function productsImages(){
    return $this->hasMany(ProductImage::class, 'product_id');
 }

    protected $fillable = [
        'title', 'slug', 'description', 'price', 'compare_price', 
        'sku', 'barcode', 'track_qty', 'qty', 'status', 
        'category_id', 'sub_category_id', 'is_featured',
    ];
    
}
