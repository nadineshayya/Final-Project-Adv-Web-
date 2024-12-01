<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DiscountCoupon;
use Carbon\Carbon;


class DiscountCodeController extends Controller
{
    public function index(Request $request){
        $discountCoupon = DiscountCoupon::latest();
        if(!empty($request->get('keyword'))){
            $discountCoupon = $discountCoupon->where('name', 'like', '%'.$request->get('keyword').'%');
        }
    
        $discountCoupon = $discountCoupon->paginate(10);
    
    
        return view('admin.coupon.list', compact('discountCoupon'));

    }

    public function create(){
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:discount_coupons,code',
            'name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'max_uses' => 'nullable|integer|min:0',
            'max_uses_user' => 'nullable|integer|min:0',
            'type' => 'required|in:percent,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:0,1',
           'starts_at' => 'required|date_format:Y-m-d H:i:s',
    'expires_at' => 'required|date_format:Y-m-d H:i:s|after_or_equal:starts_at',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Store coupon data
        $coupon = new DiscountCoupon();
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->description = $request->description;
        $coupon->max_uses = $request->max_uses;
        $coupon->max_uses_user = $request->max_uses_user;
        $coupon->type = $request->type;
        $coupon->discount_account = $request->discount_amount;
        $coupon->min_account = $request->min_amount;
        $coupon->status = $request->status;
        $coupon->starts_at = $request->starts_at ? \Carbon\Carbon::parse($request->starts_at) : null;
        $coupon->expires_at = $request->expires_at ? \Carbon\Carbon::parse($request->expires_at) : null;
        $coupon->save();

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Coupon created successfully!',
        ]);
    }

    public function edit($id){
        $coupon = DiscountCoupon::findOrFail($id);

    
    return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id){
        $coupon = DiscountCoupon::findOrFail($id);

        // Validation rules
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:discount_coupons,code,' . $coupon->id,
            'name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'max_uses' => 'nullable|integer|min:0',
            'max_uses_user' => 'nullable|integer|min:0',
            'type' => 'required|in:percent,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:0,1',
            'starts_at' => 'required|date_format:Y-m-d\TH:i',
            'expires_at' => 'required|date_format:Y-m-d\TH:i|after_or_equal:starts_at',
        ]);
        
        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
       
        
        
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->description = $request->description;
        $coupon->max_uses = $request->max_uses;
        $coupon->max_uses_user = $request->max_uses_user;
        $coupon->type = $request->type;
        $coupon->discount_account = $request->discount_amount;
        $coupon->min_account = $request->min_amount;
        $coupon->status = $request->status;
        $coupon->starts_at = $request->starts_at ? \Carbon\Carbon::parse($request->starts_at) : null;
        $coupon->expires_at = $request->expires_at ? \Carbon\Carbon::parse($request->expires_at) : null;
        $coupon->save();
    
        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Coupon updated successfully!',
        ]);
    }

    
    public function applyDiscount(Request $request)
    {
        $code = DiscountCoupon::where('code', $request->code)->first();
    
        if (!$code) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount code.',
            ]);
        }
    
        $cart = session()->get('cart', []); // Get the cart from the session
        $subtotal = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart)); //
        $discountAmount = $code->discount_account;
    
        // Calculate grand total based on discount type
        if ($code->type === 'percent') {
            $discountAmount = (($discountAmount / 100) * $subtotal)+20 ;
        }
    
        $grandTotal = $subtotal - $discountAmount;
    
        // Make sure the response includes the discount_account and grandTotal
        return response()->json([
            'status' => true,
            'grandTotal' => $grandTotal,
            'discount' => [
                'discount_account' => $discountAmount,  // Ensure this is included
            ],
        ]);
    }
    
    public function destroy($id)
{
    // Find the coupon by its ID
    $coupon = DiscountCoupon::findOrFail($id);

    // Delete the coupon
    $coupon->delete();

    // Return success response
    return response()->json([
        'status' => true,
        'message' => 'Coupon deleted successfully!',
    ]);
}



    

}

