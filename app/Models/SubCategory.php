<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status', 'category_id'];

    // Subcategory model
public function products()
{
    return $this->belongsToMany(Product::class, 'product_subcategory'); // Adjust the pivot table name if needed
}


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
