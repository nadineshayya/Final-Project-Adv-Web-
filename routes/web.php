<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminloginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SubCategoryController ;
use App\Http\Controllers\admin\ProductController ;
use App\Http\Controllers\admin\ProductSubCategoryController ;
use App\Http\Controllers\admin\ProductImageController ;
use App\Http\Controllers\admin\UserController ;
use App\Http\Controllers\Frontcontroller;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\OrderController;

Route::get('/', [Frontcontroller::class,'index'])->name('front.home');
Route::get('/about-us', [Frontcontroller::class,'aboutus'])->name('front.aboutus');
Route::get('/contact-us', [Frontcontroller::class,'contactus'])->name('front.contactus');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class,'index'])->name('front.shop');
Route::get('/product/{slug}', [ShopController::class,'product'])->name('front.product');
Route::get('/cart', [CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart', [CartController::class,'addToCart'])->name('front.addToCart');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('front.updateQuantity');
Route::get('/checkout',  [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/process-checkout',  [CartController::class, 'processCheckout'])->name('front.processCheckout');
Route::get('/thank-you/{id}', [CartController::class, 'thankyou'])->name('front.thankyou');
Route::get('/profile', [AuthController::class,'profile'])->name('account.profile');

Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('front.applyDiscount');
Route::post('/add-to-wishlist', [FrontController::class, 'addToWishlist'])->name('front.addToWishlist');

Route::group(['prefix' => 'account'], function() {
    Route::group(['Middleware' => 'guest'], function() {
        Route::get('/login', [AuthController::class,'login'])->name('account.login');
        Route::get('/register', [AuthController::class,'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class,'processRegister'])->name('account.processRegister');
        Route::post('/login', [AuthController::class,'authenticate'])->name('account.authenticate');
        Route::get('/logout', [AuthController::class,'logout'])->name('account.logout');
      
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile'); 
        Route::get('/myorder', [AuthController::class, 'order'])->name('front.account.orders'); 
        Route::get('/order-details/{id}', [AuthController::class, 'orderDetail'])->name('front.account.order-details'); 
        Route::get('/mywishlist', [FrontController::class, 'whishlist'])->name('front.account.whishlist'); 
        Route::post('/wishlist/remove', [FrontController::class, 'removeFromWishlist'])->name('front.removeFromWishlist');
        Route::get('/change-password', [AuthController::class, 'changePassword'])->name('front.account.changePassword'); 
        Route::post('/process-change-password', [AuthController::class, 'changePass'])->name('account.changePass');
    });
    
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



        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');
     
        Route::put('/sub-categories/{subcategory}/update', [SubCategoryController::class, 'update'])->name('sub-categories.update');

        Route::delete('/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');

        Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        
        Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/get-products', [ProductController::class,'getPorducts'])->name('products.getPorducts');

        Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images/{image}', [ProductImageController::class, 'destroyImage'])->name('product-images.destroy');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

        Route::get('/coupon/create', [DiscountCodeController::class, 'create'])->name('coupon.create');
        Route::post('/coupon/store', [DiscountCodeController::class, 'store'])->name('coupon.store');
        Route::get('/coupon', [DiscountCodeController::class, 'index'])->name('coupon.index');
        Route::get('/coupon/edit/{id}', [DiscountCodeController::class, 'edit'])->name('coupon.edit');
        Route::post('/coupon/update/{id}', [DiscountCodeController::class, 'update'])->name('coupon.update');
     
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
      
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
      
       Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

        Route::get('/order', [OrderController::class, 'order'])->name('orders.order'); 
        //Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
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
