<?php

use App\Http\Controllers\Api\ApiProductContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Admin;


use App\Http\Controllers\Api\ApiAuthController;


// Route::get('/user', function (Request $request) {
//   return $request->user();
// })->middleware('auth:sanctum');

// Route::middleware([
//   'auth:sanctum',

//   config('jetstream.auth_session'),
// ])->group(function () {

Route::controller(ApiProductContoller::class)->group(function () {

  Route::get('allproducts',  'index')->name('api.products.index');
  Route::get('product/create', 'create')->name('api.products.create');
  Route::post('product', 'store')->name('api.products.store');
  Route::get('product/show/{id}', 'show')->name('api.products.show');
  Route::match(['PUT', 'POST'], 'product/update/{id}', 'update')->name('api.products.update');
  Route::delete('product/destroy/{id}', 'destroy')->name('api.products.destroy');
});
Route::controller(ApiAuthController::class)->group(function () {
  Route::post('login', 'login')->name('api.login');
  Route::post('register', 'register')->name('api.register');
  Route::post('logout', 'logout')->name('api.logout');
});

// });