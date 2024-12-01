<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\CustomerAddresses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DiscountCoupon;
use Carbon\Carbon;

class CartController extends Controller
{
    // Add product to the cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $product = Product::with('product_images')->find($request->product_id);
    
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ]);
        }
    
        // Fetch the first product image
       
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => 1,
                // Store the relative path to the image or null if no image exists
                'image' =>(!empty($product->product_images)) ? $product->product_images->first() : '',
            ];
        }
    
        session()->put('cart', $cart);
    
        return response()->json([
            'status' => true,
            'message' => $product->title . ' added to cart',
        ]);
    }
    

    public function cart()
{
    
    // Retrieve the cart from the session
 
    $cart = session()->get('cart', []);
  
    
        
        // Fetch product details with images for each cart item
      
    
    // Calculate the subtotal
    $subtotal = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // Calculate shipping (you can adjust this logic as needed)
    $shipping = 20;

    // Calculate the total
    $total = $subtotal + $shipping;

    // Pass cart, subtotal, shipping, and total to the view
    return view('front.cart', compact('cart', 'subtotal', 'shipping', 'total'));
}
public function updateCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Get the product
    $product = Product::find($request->product_id);

    if (!$product) {
        return response()->json(['status' => false, 'message' => 'Product not found']);
    }

    // Update the quantity in the cart
    $cartItem = Cart::get($product->id);  // Get the item from the cart

    if ($cartItem) {
        Cart::update($product->id, $request->quantity);  // Update the quantity
    } else {
        return response()->json(['status' => false, 'message' => 'Product not in cart']);
    }

    // Recalculate the updated price for this item
    $updatedPrice = $product->price * $request->quantity;

    // Recalculate the total cart price
    $updatedTotal = Cart::total();  // Get the total price of all items in the cart
    $updatedSubtotal = Cart::subtotal();  // Get the updated subtotal

    return response()->json([
        'status' => true,
        'updatedPrice' => number_format($updatedPrice, 2),  // Return the updated price for this product
        'updatedTotal' => number_format($updatedTotal, 2),  // Return the updated total cart price
        'updatedSubtotal' => number_format($updatedSubtotal, 2),  // Return the updated subtotal
    ]);
}

public function updateQuantity(Request $request)
{
    $productId = $request->productId;
    $newQuantity = $request->quantity;

    // Retrieve the cart from session
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] = $newQuantity;
        $cart[$productId]['total'] = $newQuantity * $cart[$productId]['price'];
        session()->put('cart', $cart);

        $subtotal = array_sum(array_column($cart, 'total'));
        $itemTotal = $cart[$productId]['total'];

        return response()->json([
            'status' => true,
            'newQuantity' => $newQuantity,
            'subtotal' => $subtotal,
            'itemTotal' => $itemTotal,
        ]);
    }

    return response()->json(['status' => false]);
}

public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    foreach ($cart as $index => $item) {
        if ($item['id'] == $id) {
            // Remove the item from the cart
            unset($cart[$index]);
            break;
        }
    }

    // Save the updated cart back to the session
    session()->put('cart', array_values($cart));

    return redirect()->route('front.cart');
}


public function checkout(Request $request)
{
    // Get the cart and discount from the session
    $cart = session()->get('cart', []);
    $discount = session()->get('discount', null);

    // Check if the cart is empty
    if (empty($cart)) {
        return redirect()->route('front.cart')->with('error', 'Your cart is empty. Add items before proceeding to checkout.');
    }

    // Recalculate subtotal
    $subtotal = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    // Apply discount if there is a valid coupon in the session
    if ($discount && is_object($discount)) {
        $discountAmount = $discount->discount_amount;
        // If the discount is a percentage, calculate the percentage off
        if ($discount->type === 'percent') {
            $discountAmount = ($discountAmount / 100) * $subtotal;
        }
    } else {
        $discountAmount = 0; // No discount applied
    }

    // Calculate the total after discount
    $subtotalAfterDiscount = $subtotal - $discountAmount;
    $shipping = 20; // Flat rate for shipping
    $total = $subtotalAfterDiscount + $shipping;

    // If the user is not logged in, redirect to login
    if (!Auth::check()) {
        session(['url.intended' => url()->current()]);
        return redirect()->route('account.login')->with('error', 'Please login to proceed to checkout.');
    }

    session()->forget('url.intended'); // Clear the intended URL after login
    $countries = Country::orderBy('name', 'ASC')->get();

    // Proceed to the checkout view with the necessary data
    return view('front.account.checkout', [
        'countries' => $countries,
        'cart' => $cart,
        'discount' => $discount,  // Pass the discount object to the view
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total,  // Total after discount and shipping
    ]);
}




   
public function processCheckout(Request $request)
{
    // Validate form input
    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required',
        'country' => 'required',
        'address' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Please fix the errors',
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    if (!Auth::check()) {
        return response()->json([
            'message' => 'User is not authenticated',
            'status' => false,
        ], 401);
    }

    $user = Auth::user();
    $discount = session()->get('discount', ['code' => null, 'discount_amount' => 0, 'grand_total' => 0]);

    $cart = session()->get('cart', []);
    $shipping = 20;
    $subTotal = array_sum(array_column($cart, 'price'));
    $grandTotal = $discount['grand_total'] ?: ($subTotal + $shipping);

    $order = new Order;
    $order->user_id = $user->id;
    $order->subtotal = $subTotal;
    $order->shipping = $shipping;
    $order->coupon_code = $discount['code'];
    $order->discount = $discount['discount_amount'];
    $order->grand_total = $grandTotal;
    $order->first_name = $request->first_name;
    $order->last_name = $request->last_name;
    $order->email = $request->email;
    $order->mobile = $request->mobile;
    $order->country_id = $request->country;
    $order->address = $request->address;
    $order->notes = $request->order_notes;

    $order->save();

    // Save order items
    foreach ($cart as $cartItem) {
        OrderItems::create([
            'order_id' => $order->id,
            'product_id' => $cartItem['id'],
            'name' => $cartItem['title'],
            'qty' => $cartItem['quantity'],
            'price' => $cartItem['price'],
            'total' => $cartItem['quantity'] * $cartItem['price'],
        ]);
    }

    // Clear the cart and discount session after checkout
    session()->forget('cart');
    session()->forget('discount');

    return response()->json([
        'message' => 'Order placed successfully',
        'status' => true,
        'order_id' => $order->id,
    ]);
}


public function thankyou($id){
    return view('front.thankyou',[
        'id' => $id
    ]);
}


public function applyDiscount(Request $request)
{
    $code = DiscountCoupon::where('code', $request->code)->first();
    $shipping = 20;
    if (!$code) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid discount code.',
        ]);
    }

    $cart = session()->get('cart', []); // Get the cart from the session
    $subtotal = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    $discountAmount = $code->discount_account;

    if ($code->type === 'percent') {
        $discountAmount = ($discountAmount / 100) * $subtotal;
    }

    $grandTotal = $subtotal - $discountAmount;
    $grandTotal =  $grandTotal + $shipping;
    // Store discount details in the session
    session()->put('discount', [
        'code' => $code->code,
        'discount_amount' => $discountAmount,
        'grand_total' => $grandTotal,
    ]);

    return response()->json([
        'status' => true,
        'grandTotal' => $grandTotal,
        'discount' => [
            'discount_account' => $discountAmount,
        ],
    ]);
}






}


