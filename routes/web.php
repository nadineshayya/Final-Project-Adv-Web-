<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminloginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SubCategoryController ;
use App\Http\Controllers\admin\ProductController ;
use App\Http\Controllers\admin\ProductSubCategoryController ;
Route::get('/', function () {
    return view('welcome');
});




Route::group(['prefix' => 'admin'], function() {

    Route::group(['Middleware' => 'admin.guest'], function() {
        Route::get('/login', [AdminloginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminloginController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['Middleware' => 'admin.auth'], function() {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
      
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
      
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
      
        Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');

        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');

        Route::get('/sub-categories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');



        Route::post('/upload-temp-image', [CategoryController::class, 'create'])->name('temp-images.create');
     
        Route::put('/sub-categories/{subcategory}/update', [SubCategoryController::class, 'update'])->name('sub-categories.update');

        Route::delete('/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');

        Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');

       
        Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
        Route::get('/getSlug',function(Request $request){
            $slug='';
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status'=>true,
                'slug'=> $slug
            ]);
        })->name('getSlug');
    });



  

});
