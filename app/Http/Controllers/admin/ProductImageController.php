<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;

class ProductImageController extends Controller
{
    public function updateImages(Request $request, $productId)
    {
        \Log::debug('CSRF Token:', ['csrf' => $request->header('X-CSRF-TOKEN')]);

        $product = Product::find($productId);
    
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }
    
        // Handle image update logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            // Delete old image if exists
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
    
            // Save new image
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
    
            // Update product image field
            $product->image = $imageName;
            $product->save();
    
            \Log::debug('Image updated successfully', ['image' => $imageName]);
        } else {
            \Log::debug('No image uploaded');
        }
    }
    
    public function destroyImage($imageId)
{
    try {
        // Log the received image ID for debugging
        \Log::debug('Attempting to delete image with ID: ' . $imageId);

        $productImage = ProductImage::find($imageId);

        if (!$productImage) {
            \Log::error('Image not found for ID: ' . $imageId);
            return response()->json(['status' => false, 'message' => 'Image not found.']);
        }

        // Delete the physical file
        $imagePath = public_path('images/products/' . $productImage->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
            \Log::debug('Image file deleted: ' . $imagePath);
        } else {
            \Log::warning('Image file not found: ' . $imagePath);
        }

        // Delete the database record
        $productImage->delete();
        \Log::debug('Image record deleted for ID: ' . $imageId);

        return response()->json(['status' => true, 'message' => 'Image removed successfully.']);
    } catch (\Exception $e) {
        \Log::error('Error while deleting image', ['error' => $e->getMessage()]);
        return response()->json(['status' => false, 'message' => 'Failed to delete image.', 'error' => $e->getMessage()]);
    }
}

    
    
}
