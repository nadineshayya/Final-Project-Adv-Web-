<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Frontcontroller extends Controller
{

    public function index(){
        $products = Product::where('is_featured', 'Yes')->orderBy('id', 'DESC')->where('status',1)->get();
       $data['featuredProducts']= $products;

       $latestproducts = Product::orderBy('id', 'DESC')->where('status',1)->take(8)->get();
       $data['latestproducts']= $latestproducts;
        return view('front.home' ,  $data);
    }
    public function addToWishlist(Request $request)
{
    if (!Auth::check()) {
        session(['url.intended' => url()->previous()]);
        return response()->json([
            'status' => false,
            'message' => 'You need to log in to add products to your wishlist.'
        ]);
    }

    // Check if the product already exists in the wishlist
    $exists = Wishlist::where('user_id', Auth::id())
                      ->where('product_id', $request->product_id)
                      ->exists();

    if ($exists) {
        return response()->json([
            'status' => false,
            'message' => 'This product is already in your wishlist.'
        ]);
    }

    try {
        // Save to the wishlist
        $wishlist = new Wishlist;
        $wishlist->user_id = Auth::id();
        $wishlist->product_id = $request->product_id;
        $wishlist->save();

        return response()->json([
            'status' => true,
            'message' => 'Product added to your wishlist.'
        ]);
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error adding to wishlist: ' . $e->getMessage());

        return response()->json([
            'status' => false,
            'message' => 'Error while adding product to wishlist.'
        ]);
    }
}

    public function whishlist(){

        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        $data =[];
        $data['wishlists']=$wishlists ;
     
       return view('front.account.wishlist', $data);
    }
    public function removeFromWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'You need to log in to remove items from your wishlist.'
            ]);
        }
    
        // Check if product_id is provided
        if (!$request->has('product_id')) {
            return response()->json([
                'status' => false,
                'message' => 'Product ID is missing from the request.'
            ]);
        }
    
        try {
            // Attempt to delete the wishlist entry
            $deleted = Wishlist::where('user_id', Auth::id())
                               ->where('product_id', $request->product_id)
                               ->delete();
    
            if ($deleted) {
                return response()->json([
                    'status' => true,
                    'message' => 'Product removed from your wishlist.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found in your wishlist.'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error removing from wishlist: ' . $e->getMessage());
    
            return response()->json([
                'status' => false,
                'message' => 'Error while removing product from wishlist.'
            ]);
        }
    }
    

    
    
}
