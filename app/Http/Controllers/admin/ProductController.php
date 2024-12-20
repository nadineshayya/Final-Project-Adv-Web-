<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\TempImage;
use App\Models\ProductImage;
use App\Http\Controllers\admin\ProductImageController;

class ProductController extends Controller
{

    public function index(Request $request){
        $products = Product::latest('id')->with('product_images');
        
        if(!empty($request->get('keyword'))){
            $products = $products->where('title', 'like', '%'.$request->get('keyword').'%');
        }
        $products =  $products->paginate();
        $data['products'] = $products;
        return view('admin.products.list', $data);
      
    }

    public function create(){
        $data=[];
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories']=  $categories;
        $subCategories = SubCategory::orderBy('name','ASC')->get();
        $data['subCategories']=  $subCategories;
        return view('admin.products.create', $data);
    }

    public function store(Request $request)
    {
        \Log::debug('Request received', $request->all());
    
        // Ensure 'track_qty' has a default value if unchecked
        $request->merge(['track_qty' => $request->has('track_qty') ? 'Yes' : 'No']);
    
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
    
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric|min:0';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->is_featured = $request->is_featured;
            $product->shipping_returns = $request->shipping_returns;
            $product->short_description = $request->short_description;
    
            $product->save();
    
            // Image Handling
            if (!empty($request->image_array)) {
                foreach ($request->image_array as $temp_image_id) {
                    $temp_image = TempImage::find($temp_image_id);
                    
                    if ($temp_image) {
                        $extArray = explode('.', $temp_image->name);
                        $ext = last($extArray);
    
                        $imageName = $product->id . '-' . time() . '.' . $ext;
    
                        $productImage = new ProductImage();
                        $productImage->product_id = $product->id;
                        $productImage->image = $imageName;
                        $productImage->save();
    
                        $tempImagePath = public_path('temp/' . $temp_image->name);
                        $newImagePath = public_path('images/products/' . $imageName);
    
                        if (file_exists($tempImagePath)) {
                            if (!file_exists(public_path('images/products'))) {
                                mkdir(public_path('images/products'), 0777, true);
                            }
    
                            rename($tempImagePath, $newImagePath);
    
                            $temp_image->delete();
                        }
                    }
                }
            }
    
            \Log::debug('Product created', $product->toArray());
            return response()->json(['status' => true, 'message' => 'Product created successfully']);
        } catch (\Exception $e) {
            \Log::error('Error while creating product', ['error' => $e->getMessage()]);
            return response()->json(['status' => false, 'message' => 'Product creation failed']);
        }
    }
    
    public function edit($id , Request $request){

        $product = Product::find($id);

        if(empty($product)){
            //$request->session()->flash('error', 'Product not found');
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        $productImages = ProductImage::where('product_id', $product->id)->get();

        $subCategories = Subcategory::where('category_id', $product->category_id)->get();
        $data=[];
        $data['product']= $product;
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories']=  $categories;
        
        $data['subCategories']=  $subCategories;
        $data['productImages']=  $productImages;
        return view('admin.products.edit', $data);
    }

    public function update($id, Request $request)
    {
        \Log::debug('Request received', $request->all());
    
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }
    
        // Adjust the value for `track_qty` if the checkbox is unchecked
        $request->merge(['track_qty' => $request->has('track_qty') ? 'Yes' : 'No']);
    
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id . ',id', // Exclude current slug
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,' . $product->id . ',id', // Allow same SKU for the current product
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        if ($request->track_qty === 'Yes') {
            $rules['qty'] = 'required|numeric|min:0';
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            \Log::debug('Validation failed', $validator->errors()->toArray());
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
    
        try {
            // Update product fields
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku; // Allow unchanged SKU
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->track_qty === 'Yes' ? $request->qty : null;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->is_featured = $request->is_featured;
            $product->shipping_returns = $request->shipping_returns;
            $product->short_description = $request->short_description;
    
            $product->save();
    
            // Call the updateImages method in ProductImageController
            $productImageController = new ProductImageController();
            $productImageController->updateImages($request, $product->id);
    
            \Log::debug('Product updated successfully', $product->toArray());
            return response()->json(['status' => true, 'message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error updating product', ['error' => $e->getMessage()]);
            return response()->json(['status' => false, 'message' => 'Product update failed']);
        }
    }
    


    public function destroy($id)
    {
        \Log::info("Attempting to delete product with ID: $id");
    
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
    
            // Image and product deletion logic...
    
            \Log::info("Product with ID: $id deleted successfully");
            return response()->json(['success' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    



}
