<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;

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
        // Return validation errors with input back to the form
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput($request->all());
    }
    

    // Create and save the user
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->save();

    // Flash success message
    session()->flash('success', 'You have been registered successfully.');

    // Redirect to the login page
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

}
