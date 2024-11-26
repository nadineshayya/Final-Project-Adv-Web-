<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class Frontcontroller extends Controller
{

    public function index(){
        $products = Product::where('is_featured', 'Yes')->orderBy('id', 'DESC')->where('status',1)->get();
       $data['featuredProducts']= $products;

       $latestproducts = Product::orderBy('id', 'DESC')->where('status',1)->take(8)->get();
       $data['latestproducts']= $latestproducts;
        return view('front.home' ,  $data);
    }
}
