<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   public function index(){

   }
   public function create(){
    return view('admin.category.create');
   }
   
   public function store(Request $request){
    Log::info('Request Data:', $request->all()); 
     $validator = Validator::make($request->all(),[
        'name'=> 'required',
        'slug' => 'required|unique:categories',
     ]);

     if ($validator->fails()) {
      return response()->json([
          'status' => false,
          'errors' => $validator->errors()
      ]);}
      
   }
   public function edit(){
    
   }
   public function update(){
    
   }
   public function destroy(){
    
   }
}
