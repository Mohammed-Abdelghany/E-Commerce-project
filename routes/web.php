<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\ChangeLanguage;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;






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
  Route::controller(ProductController::class)->group(function () {

    Route::get('/create', 'create')->name('products.create')->middleware(Admin::class);
    Route::post('/store', 'store')->name('products.store')->middleware(Admin::class);
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/edit/{id}', 'edit')->name('products.edit')->middleware(Admin::class);
    Route::put('/update/{id}', 'update')->name('products.update')->middleware(Admin::class);
    Route::delete('/destroy/{id}', 'destroy')->name('products.destroy')->middleware(Admin::class);
  });
});
Route::get('allproducts', [ProductController::class, 'index'])->middleware(ChangeLanguage::class)->name('products.index');
Route::get('/home/{lang}', action: function ($lang) {
  if ($lang == 'ar') {
    Session::put('locale', 'ar');
  } else {
    Session::put('locale', 'en');
  }
  return redirect()->back();
})->middleware(ChangeLanguage::class)->name('home.lang');
