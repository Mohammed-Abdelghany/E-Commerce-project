<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function home()
  {

    if (Auth::check() && Auth::user()->role === '1') {

      return view('admin.home')->with('users', User::paginate(10));
    }
    return view('user.home')->with('products', Product::paginate(6));
  }

  //
}
