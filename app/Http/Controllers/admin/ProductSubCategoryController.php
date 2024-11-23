<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory; 
use Illuminate\Http\Request;


class ProductSubCategoryController extends Controller
{
    public function create()
    {
        // Fetch all categories
        $categories = Category::all();

        // Fetch subcategories for each category
        foreach ($categories as $category) {
            $category->subCategories = SubCategory::where('category_id', $category->id)->orderBy('name', 'ASC')->get();
        }

        // Return the view with categories and their subcategories
        return view('admin.product.create', compact('categories'));
    }

    public function index(Request $request)
    {
        if (!empty($request->category_id)) {
            $subCategories = SubCategory::where('category_id', $request->category_id)
                ->orderBy('name', 'ASC')
                ->get();

            return response()->json([
                'status' => true,
                'subCategories' => $subCategories
            ]);
        } else {
            return response()->json([
                'status' => true,
                'subCategories' => []
            ]);
        }
    }
}

