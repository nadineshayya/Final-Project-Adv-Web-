<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Models\SubCategory;


class SubCategoryController extends Controller
{

    public function index(Request $request)
    {
        // Initialize the query builder for SubCategories
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
        ->latest('sub_categories.id')
        ->leftJoin('categories','categories.id','sub_categories.category_id');
    
        // If there's a keyword, apply the filter
        if (!empty($request->get('keyword'))) {
            $subCategories = $subCategories->where('sub_categories.name', 'like', '%' . $request->get('keyword') . '%');
            $subCategories = $subCategories->orwhere('categories.name', 'like', '%' . $request->get('keyword') . '%');
        }
    
        // Paginate the result
        $subCategories = $subCategories->paginate(10);
    
        // Pass the paginated result to the view
        return view('admin.sub_category.list', compact('subCategories'));
    }
    

    public function create()
    {
        // Fetch categories as a collection
        $categories = Category::orderBy('name', 'ASC')->get(); 
        $data['categories'] = $categories;
    
        return view('admin.sub_category.create', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'slug' => 'required|unique:sub_categories',
            'category'=>'required',
            'status' => 'required'
        ]);

        if($validator->passes()){

            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;   
            $subCategory->save();
            
            $request->session()->flash('success', 'Sub category created successfully.');

            return response([
                'status'=>true,
                'message' => 'Sub category created successfully.'
                
            ]);

        }else{
         return response([
                'status'=>false,
                'errors'=> $validator ->errors()
            ]);
        }

    }
    public function edit($id, Request $request)
    {
        $subCategory = SubCategory::find($id);
        if (empty($subCategory)) {
            $request->session()->flash('error', 'Record not found');
            return redirect()->route('sub-categories.index');
        }
    
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.sub_category.edit', compact('subCategory', 'categories'));
    }
    

    public function update($id, Request $request)
    {
        // Find the subcategory by ID
        $subCategory = SubCategory::find($id);
    
        // Check if subcategory exists
        if (empty($subCategory)) {
            $request->session()->flash('error', 'Record not found');
            return response([
                'status' => false,
                'notFound' => true
            ]);
        }
    
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,' . $subCategory->id,
            'category' => 'required',
            'status' => 'required'
        ]);
    
        if ($validator->passes()) {
            // Update the subcategory
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->save();
    
            $request->session()->flash('success', 'Subcategory updated successfully.');
    
            return response([
                'status' => true,
                'message' => 'Subcategory updated successfully.'
            ]);
        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function destroy($id, Request $request)
{
    // Find the subcategory by ID
    $subCategory = SubCategory::find($id);

    // Check if the subcategory exists
    if (empty($subCategory)) {
        $request->session()->flash('error', 'Subcategory not found.');
        return response([
            'status' => false,
            'message' => 'Subcategory not found.'
        ]);
    }

    // Delete the subcategory
    $subCategory->delete();

    $request->session()->flash('success', 'Subcategory deleted successfully.');

    return response([
        'status' => true,
        'message' => 'Subcategory deleted successfully.'
    ]);
}
public function getSubcategories(Request $request)
{
    $category_id = $request->category_id;

    // Fetch subcategories belonging to the selected category
    $subCategories = SubCategory::where('category_id', $category_id)->get();

    return response()->json(['subCategories' => $subCategories]);
}

    
}
