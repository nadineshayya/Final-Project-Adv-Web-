<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $categorySelected = null;
        $subCategorySelected = null;
        
        // Fetch categories with their subcategories
        $categories = Category::orderBy('name', 'ASC')
            ->with('sub_category')
            ->where('status', 1)
            ->get();
        
        // Initialize the query for products
        $products = Product::where('status', 1);
        
        // Filter by category if slug is provided
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $products->where('category_id', $category->id);
                $categorySelected = $category->id;
            }
        }
        
        // Filter by subcategory if slug is provided
        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
            if ($subCategory) {
                $products->where('sub_category_id', $subCategory->id);
                $subCategorySelected = $subCategory->id;
            }
        }
        
        // Filter by price range if provided
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $products->whereBetween('price', [$request->price_min, $request->price_max]);
        }
        
        // Search functionality
        if (!empty($request->get('search'))) {
            $products->where('title', 'like', '%' . $request->get('search') . '%');
        }
        
        // Order and paginate products
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        
        // Prepare data for the view
        $data = [
            'categories' => $categories,
            'products' => $products,
            'categorySelected' => $categorySelected,
            'subCategorySelected' => $subCategorySelected,
        ];
        
        return view('front.shop', $data);
    }
    
    

    public function product($slug){
       $product = Product::where('slug',$slug)->with('product_images')->first();
       if($product == null){
        abort(404);
       }
       $data['product'] = $product;
       return view('front.product' ,$data);
        
    
    }
}
