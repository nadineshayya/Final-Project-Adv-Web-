<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\Order; 
use App\Models\OrderItems; 

class AuthController extends Controller
{
   public function login(){
    return view('front.account.login');
   }
   public function register(){
    return view('front.account.register');
   }

   public function processRegister(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:5|confirmed',
    ]);

    if ($validator->fails()) {
        if ($request->ajax()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput($request->all());
    }

    // Create and save the user with default role
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->role = 2; // Set the default role
    $user->save();

    if ($request->ajax()) {
        return response()->json([
            'status' => true,
            'message' => 'Registration successful.',
        ]);
    }

    session()->flash('success', 'You have been registered successfully.');
    return redirect()->route('account.login');
}

public function authenticate(Request $request){
    $validator = Validator::make($request->all(), [
        'email'=> 'required|email',
        'password'=>'required',
    ]);

    if($validator->passes()){

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $request->get
        ('remember'))){

            return redirect()->route('account.profile');
        }else{
           // session()->flash('error', 'Either email/password is incorrect.');
            return redirect()->route('account.login')
            ->withInput($request->only('email'))
            ->with('error', 'Either email/password is incorrect.');
        }
    }else{
       return redirect()->route('account.login')->withErrors($validator)
       ->withInput($validator)
       ->withInput($request->only('email'));
    }

    
  
}
public function profile(){
return view('front.account.profile');
}

public function logout(){
    Auth::logout();
    return redirect()->route('account.login')
    ->with('success','You successfully Loget Out!' );
}

public function order()
{
    // Initialize data array
    $data = [];
    
    // Retrieve authenticated user
    $user = Auth::user();
    
    if (!$user) {
        // Redirect or return a response if the user is not authenticated
        return redirect()->route('account.login')->with('error', 'You need to be logged in to view orders.');
    }
    
    // Retrieve orders for the authenticated user
    $orders = Order::where('user_id', $user->id)
        ->orderBy('created_at', 'DESC')
        ->get();
    
    $data['orders'] = $orders;

    // Return the view
    return view('front.account.orders', $data);
}

public function orderDetail($id)
{
    // Initialize data array
    $data = [];
    
    // Retrieve authenticated user
    $user = Auth::user();
    
    if (!$user) {
        // Redirect or return a response if the user is not authenticated
        return redirect()->route('account.login')->with('error', 'You need to be logged in to view order details.');
    }
    
    // Retrieve the specific order for the authenticated user
    $order = Order::where('user_id', $user->id)
        ->where('id', $id)
        ->first();
    
    if (!$order) {
        // Handle case where the order is not found
        return redirect()->route('front.account.orders')->with('error', 'Order not found or you do not have permission to view this order.');
    }
    
    $data['order'] = $order;

    // Retrieve the items for the order
    $orderItems = OrderItems::where('order_id', $id)->get();
    $data['orderItems'] = $orderItems;

    // Return the view
    return view('front.account.order-details', $data);
}

}
