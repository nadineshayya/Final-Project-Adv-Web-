<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
   public function index(Request $request){
    $categories = Category::latest();
    if(!empty($request->get('keyword'))){
        $categories = $categories->where('name', 'like', '%'.$request->get('keyword').'%');
    }

    $categories = $categories->paginate(10);

   
    return view('admin.category.list', compact('categories'));
   }

   public function create(){
    return view('admin.category.create');
   }
   
  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'slug' => 'required|unique:categories',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ]);
    }

    $category = new Category();
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->status = $request->status ?? 0;
    $category->save();
    
    if(!empty($request->image_id)){
        $tempImage = TempImage::find($request->image_id);
        $extArray = explode('.',$tempImage->name);
        $ext = last($extArray);

        $newImageName = $category->id.'.'.$ext;
        $isPath = public_path().'/temp/'.$tempImage->name;
        $dPath = public_path().'/uploads/category/'.$newImageName;
        File::copy( $isPath, $dPath);

       
        $category->image =$newImageName;
        $category->save();
    }

    $request->session()->flash('success', 'Category added successfully');
    return response()->json([
        'status' => true,
        'message' => 'Category created successfully!',
    ]);
}

   public function edit($categoryId , Request $request){
   
    $category = Category::find($categoryId);
    if(empty($category)){
        return redirect()->route('categories.index');
    }


    return view('admin.category.edit', compact('category'));
   }

   public function update(Request $request, $categoryId)
{
    $category = Category::find($categoryId);

    if (!$category) {
        return response()->json([
            'status' => false,
            'message' => 'Category not found.',
        ]);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'slug' => 'required|unique:categories,slug,' . $category->id,
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ]);
    }

    // Update category details
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->status = $request->status ?? 0;

    // Handle image update
    if (!empty($request->image_id)) {
        $tempImage = TempImage::find($request->image_id);

        if ($tempImage) {
            $extArray = explode('.', $tempImage->name);
            $ext = last($extArray);
            $newImageName = $category->id . '.' . $ext;
            $isPath = public_path('/temp/' . $tempImage->name);
            $dPath = public_path('/uploads/category/' . $newImageName);

            // Remove the existing image if it exists
            if ($category->image && File::exists(public_path('/uploads/category/' . $category->image))) {
                File::delete(public_path('/uploads/category/' . $category->image));
            }

            File::copy($isPath, $dPath);
            $category->image = $newImageName;
        }
    }

    $category->save();

    return response()->json([
        'status' => true,
        'message' => 'Category updated successfully!',
    ]);
}
public function destroy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json([
            'status' => false,
            'notFound'=> true,
            'message' => 'Category not found.',
        ]);
    }

    // Delete associated image
    if ($category->image && File::exists(public_path('/uploads/category/' . $category->image))) {
        File::delete(public_path('/uploads/category/' . $category->image));
    }

    $category->delete();

    return response()->json([
        'status' => true,
        'message' => 'Category deleted successfully!',
    ]);
}

}
