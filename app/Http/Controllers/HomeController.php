<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function home()
  {
    if (Auth::check() && Auth::user()->role === '1') {
      return view('admin.home');
    }
    return view('user.home');
  }

  //
}
