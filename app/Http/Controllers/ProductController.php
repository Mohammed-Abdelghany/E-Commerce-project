<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;












class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $products = Product::paginate(10);



    if (Auth::user()) {
      $user = Auth::user();
      if ($user->role == 1) {
        return view('admin.allproducts', compact('products'));
      }
    }
    return view('user.home', compact('products'));
  }
  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.create');
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {


    $validations = $request->validate(
      [
        'name' => 'required|string|max:50',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

      ]


    );
    if ($request->hasFile('image')) {
      $validations['image'] = Storage::putFile('public/products', $request->file('image'));


      Product::create(array_merge($validations, ['user_id' => Auth::id()]));



      return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    //

  }

  /** 
   * Display the specified resource.
   */
  public function show($id)
  {
    //

    $product = Product::findOrFail($id);
    if (!$product == null) {

      if (Auth::user()) {
        $user = Auth::user();
        if ($user->role == 1) {

          return view('admin.show', compact('product'));
        }
      }
      return view('user.show', compact('product'));
    }
    return redirect('/allproducts')->with('error', 'Product not found.');
  }



  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $product = Product::findOrFail($id);
    if (!$product == null) {
      return view('admin.edit', compact('product'));
    }
    return redirect()->route('products.index')->with('error', 'Product not found.');

    //

  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $product = Product::findOrFail($id);
    $request->validate([
      'name' => 'required|string|max:50 ',
      'price' => 'required|numeric|min:0',
      'description' => 'nullable|string',
      'quantity' => 'required|numeric|min:0',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);
    if ($request->hasFile('image')) {
      $image = Storage::putFile('/public/products', $request->file('image'));
    } else {
      $image = $product->image;
    }



    // Update product details
    $product->update([
      'name' => $request->name,
      'price' => $request->price,
      'description' => $request->description,
      'quantity' => $request->quantity,
      'image' => $image,
      'user_id' => Auth::id(),
    ]);

    // Redirect with success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    //
    $product = Product::findOrFail($id);
    if (!$product == null) {
      $product->delete();
      return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    return redirect()->route('products.index')->with('error', 'Product not found.');

    //

  }
  public function addToCart(Request $request)
  {
    $id = $request->product_id;
    $quantity = $request->quantity;
    $product = Product::find($id);

    if (!$product) {
      return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
      $cart[$id]['quantity'] += $quantity;
    } else {
      $cart[$id] = [
        'name' => $product->name,
        'price' => $product->price,
        'image' => $product->image,
        'quantity' => $quantity,
        'id' => $product->id,
      ];
    }

    session()->put('cart', $cart);
    return redirect()->route('products.cart')->with('success', 'Product added to cart successfully.');
  }

  public function cart()
  {
    return view('user.cart');
  }
  public function cartprocessed(Request $request)
  {
    $request->validate([
      'subtotal' => 'required|numeric|min:0',
      'tax' => 'required|numeric|min:0',
      'total' => 'required|numeric|min:0',
    ]);

    $cart = session()->get('cart', []);
    $total = 0;

    foreach ($cart as $id => $product) {
      $productModel = Product::findOrFail($id);
      $quantity = $product['quantity'];

      if ($productModel->quantity < $quantity) {
        return redirect()->route('home')->with('error', 'The quantity of some products is not available.');
      }

      $productModel->update([
        'quantity' => $productModel->quantity - $quantity,
      ]);

      if (!$productModel->quantity > 0) {
        $productModel->update([
          'status' => 'inactive'
        ]);
      } else {
        $productModel->update([
          'status' => 'active'
        ]);
      }

      Order::create([
        'user_id' => Auth::id(),
        'product_id' => $productModel->id,
        'quantity' => $quantity,
        'status' => 'Done',
        'total_price' => $productModel->price * $quantity,
      ]);

      $total += $productModel->price * $quantity;
    }


    Order::where('user_id', Auth::id())->latest()->first()->update(['total_price' => $total]);

    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Order placed successfully.');
  }

  public function removeFromCart($productId)
  {
    $cart = session()->get('cart', []);
    if (isset($cart[$productId])) {
      unset($cart[$productId]);
      session()->put('cart', $cart);
    }
    return redirect()->route('products.cart')->with('success', 'Product removed from cart successfully.');
  }
}
