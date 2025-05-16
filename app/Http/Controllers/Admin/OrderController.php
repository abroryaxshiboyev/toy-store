<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(); // Teskari tartibda, 10 ta sahifada
        return view('admin.orders.index', compact('orders'));
    }
}