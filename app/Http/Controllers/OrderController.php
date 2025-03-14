<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  //
  public function index()
  {
    $orders = Order::with('user', 'product')->paginate(10);

    return view('admin.orders', compact('orders'));
    //
  }
}
