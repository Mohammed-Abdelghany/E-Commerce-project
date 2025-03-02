<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ApiProductContoller extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $products = Product::all();
    if ($products == null) {
      return response()->json(['message' => 'No products found'], 404);
    } else {
      return ProductResource::collection($products);
    }

    //  
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $errors = Validator::make($request->all(), [
      'name' => 'required|string|max:20',
      'description' => 'required|string|max:255',
      'price' => 'required|numeric',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'quantity' => 'required|numeric|min:0',
    ]);
    if ($errors->fails()) {
      return response()->json([
        'errors' => $errors->errors()
      ], 422);
    }
    $image = Storage::putFile('public/products', $request->file('image'));
    Product::create([
      'name' => $request->name,
      'description' => $request->description,
      'price' => $request->price,
      'image' => $image,
      'quantity' => $request->quantity,
      'user_id' => 1,
    ]);


    return response()->json(['message' => 'Product created successfully'], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $product = Product::find($id);
    if ($product == null) {
      return response()->json(['message' => 'Product not found'], 404);
    } else {
      return new ProductResource($product);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    //
    $product = Product::find($id);
    if ($product == null) {
      return response()->json(['message' => 'Product not found'], 404);
    }

    $errors = Validator::make($request->all(), [
      'name' => 'required|string|max:20',
      'description' => 'required|string|max:255',
      'price' => 'required|numeric',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'quantity' => 'required|numeric|min:0',
    ]);
    if ($errors->fails()) {
      return response()->json([
        'errors' => $errors->errors()
      ], 422);
    }

    if ($request->hasFile('image')) {
      $image = Storage::putFile('public/products', $request->file('image'));
    } else {
      $image = $product->image;
    }
    $product->update([
      'name' => $request->name,
      'description' => $request->description,
      'price' => $request->price,
      'image' => $image,
      'quantity' => $request->quantity,
      'user_id' => 1,  // Replace with the authenticated user's ID when using authentication
    ]);
    return response()->json(['message' => 'Product updated successfully'], 201);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    //
    $product = Product::find($id);
    if ($product == null) {
      return response()->json(['message' => 'Product not found'], 404);
    }
    $product->delete();
    return response()->json(['message' => 'Product deleted successfully'], 200);
  }
}
