<?php
namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('admin.dashboard');
      //$admin=  Auth::guard('admin')->user();
       // echo 'Welcome'.$admin->name.'<a href="'.route('admin.login').'"> Logout</a>';
    }

    public function logout(){
        
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
