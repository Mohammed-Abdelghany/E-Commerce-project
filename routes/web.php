<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;


use App\Models\Order;
use App\Models\Product;

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Users;
use App\Http\Middleware\ChangeLanguage;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicEmail;
use App\Http\Controllers\GoogleAuthController;

Route::get('/', function () {
  return view('welcome');
});

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  ChangeLanguage::class,
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
  Route::get('home', [HomeController::class, 'home'])->name('home');

  Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');

  Route::delete('/userdestro/{id}', function ($id) {
    $user = User::find($id);
    if ($user) {
      $user->delete();
      return redirect()->back()->with('success', 'User deleted successfully');
    }
    return redirect()->back()->with('error', 'User not found');
  })->name('user.destroy')->middleware(Admin::class);

  Route::controller(ProductController::class)->group(function () {

    Route::get('/create', 'create')->name('products.create')->middleware(Admin::class);
    Route::post('/store', 'store')->name('products.store')->middleware(Admin::class);
    Route::get('/cart', 'cart')->name('products.cart')->middleware(Users::class);

    Route::post('/cart/{id}', 'removeFromCart')->name('products.cart.remove')->middleware(Users::class);


    Route::post('/cart/add/{id}', 'addToCart')->name('products.cart.add')->middleware(Users::class);
    Route::post('/cart', 'cartprocessed')->name('products.cart.processed')->middleware(Users::class);
    Route::get('/edit/{id}', 'edit')->name('products.edit')->middleware(Admin::class);
    Route::put('/update/{id}', 'update')->name('products.update')->middleware(Admin::class);
    Route::delete('/destroy/{id}', 'destroy')->name('products.destroy')->middleware(Admin::class);
  });

  Route::middleware(Admin::class)->controller(OrderController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders.index');

    Route::delete('order/{id}', function ($id) {
      $order = Order::find($id);
      if ($order) {
        $order->delete();
        return redirect('/orders')->with('success', 'Order deleted successfully');
      }
      return redirect('/orders')->with('error', 'Order not found');
    })->name('orders.delete');
  });
});
Route::get('/home/{lang}', action: function ($lang) {
  if ($lang == 'ar') {
    Session::put('locale', 'ar');
  } else {
    Session::put('locale', 'en');
  }
  return redirect()->back();
})->middleware(ChangeLanguage::class)->name('home.lang');
Route::get('allproducts', [ProductController::class, 'index'])->middleware(ChangeLanguage::class)->name('products.index');
Route::get('/show/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/contact', function () {
  return view('user.contact');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirectToGoogle'])->name('google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('googleCallback');
