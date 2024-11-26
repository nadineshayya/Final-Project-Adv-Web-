<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'products_images';

    /**
     * Define the inverse relationship with the Product model
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    protected $fillable = ['product_id', 'image_url'];
}
