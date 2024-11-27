<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
 use HasFactory;

 public function product_images(){
    return $this->hasMany(ProductImage::class, 'product_id');
 }
 // Product model
public function subcategories()
{
    return $this->belongsToMany(Subcategory::class, 'product_subcategory'); // Adjust the pivot table name if needed
}


    protected $fillable = [
        'title', 'slug', 'description', 'price', 'compare_price', 
        'sku', 'barcode', 'track_qty', 'qty', 'status', 
        'category_id', 'sub_category_id', 'is_featured',
    ];
    
}
