<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        // Initialize the query builder
        $orders = Order::query();
    
        // Apply date filtering if a date is provided
        if ($request->filled('date')) {
            $orders->whereDate('created_at', $request->date);
        }
    
        // Apply sorting and pagination
        $orders = $orders->latest()->paginate(10);
    
        // Pass the orders and the selected date to the view
        return view('admin.orders.list', compact('orders', 'request'));
    }
    
    
}
