<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug =null , $subCategorySlug = null ){

        $categorySelected ='';
        $subCategorySelected ='';

        $categories =Category::orderBy('name', 'ASC')->with('sub_category')->where('status',1)->get();
        $products = Product::orderBy('title', 'DESC')->where('status',1)->get();



        $products = Product::where('status',1);

        if(!empty($categorySlug)){
            $category =Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }

        if(!empty($subCategorySlug)){
            $subCategory =SubCategory::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }

        $products = Product::query();

    // Filter by price range
    if ($request->filled('price_min') && $request->filled('price_max')) {
        $products = $products->whereBetween('price', [$request->price_min, $request->price_max]);
    }


        $products = $products->orderBy('id', 'DESC');
        $products = $products->paginate(6);


        $data['categories'] = $categories;
        $data['products'] = $products;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['categorySelected'] = $categorySelected;

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
