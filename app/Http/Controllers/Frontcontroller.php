<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Frontcontroller extends Controller
{
    public function index(){
        return view('front.home');
    }
}
