@extends('user.layouts.app')
@section('content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <div class="container py-5">
    <h1 class="mb-4 text-center">🛒 Shopping Cart</h1>

    <div class="row">
    <div class="col-lg-8">
      <!-- 🏷️ Cart Items -->
      <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <div id="cart-items">
        @if (!empty(session()->get('cart')))
      @foreach (session()->get('cart') as $id => $product)
      <div class="row cart-item mb-4 align-items-center">
      <div class="col-md-3">
      <img src="{{ asset('storage/' . $product['image']) }}" class="img-fluid rounded shadow-sm">
      </div>
      <div class="col-md-5">
      <h5 class="card-title mb-1">{{ $product['name'] }}</h5>
      <span class="item-price">${{ number_format($product['price'], 2) }}</span>
      </div>
      <div class="col-md-3">
      <div class="input-group">
      <button class="btn btn-outline-secondary btn-sm btn-decrease">-</button>
      <input type="text" name="quantities[{{ $id }}]"
      class="form-control form-control-sm text-center quantity-input" value="{{ $product['quantity'] }}">
      <button class="btn btn-outline-secondary btn-sm btn-increase">+</button>
      </div>
      </div>
      <div class="col-md-1 text-end">
      <form action="{{ route('products.cart.remove', $id) }}" method="post">
      @csrf
      <button class="btn btn-danger btn-sm btn-remove" data-id="{{ $id }}">🗑️</button>
      </form>
      </div>
      </div>
      <hr>
    @endforeach
    @else
    <div class="alert alert-info">No items in your cart.</div>
  @endif
        </div>
        <hr>
      </div>
      </div>
      <div class="text-center mt-3">
      <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
        <i class="bi bi-arrow-left me-2"></i> Continue Shopping
      </a>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- 💰 Order Summary -->
      <form action="{{ route('products.cart.processed') }}" method="post">
      @csrf
      <div class="card shadow-sm">
        <div class="card-body">
        <h5 class="card-title mb-3">Order Summary</h5>
        <div class="d-flex justify-content-between mb-2">
          <span>Subtotal</span>
          <span id="subtotal"></span>
          <input type="hidden" id="subtotal-input" name="subtotal"
          value="{{ ($product['price'] ?? 0) * ($product['quantity'] ?? 1) }}">
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Shipping</span>
          <span>$10.00</span>
          <input type="hidden" id="shipping-input" name="shipping" value="10">
        </div>
        <div class="d-flex justify-content-between mb-3">
          <span>Tax</span>
          <span>$20.00</span>
          <input type="hidden" id="tax-input" name="tax" value="20">
        </div>
        <hr>
        <div class="d-flex justify-content-between mb-4">
          <strong>Total</strong>
          <strong id="total">$229.97</strong>
          <input type="hidden" id="total-input" name="total" value="">
        </div>
        <button name='submit' class="btn btn-primary w-100">Proceed to Checkout</button>
        </div>
      </div>
      </form>
      <!-- 🎟️ Promo Code -->
      <div class="card mt-4 shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Apply Promo Code</h5>
        <div class="input-group">
        <input type="text" class="form-control" placeholder="Enter promo code">
        <button name='submit' class="btn btn-outline-secondary">Apply</button>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
    function updateTotal() {
      let subtotal = 0;
      document.querySelectorAll(".cart-item").forEach(item => {
      let quantity = parseInt(item.querySelector(".quantity-input").value);
      let price = parseFloat(item.querySelector(".item-price").textContent.replace("$", ""));
      subtotal += quantity * price;
      console.log(item);

      });

      let shipping = 10.00;
      let tax = 20.00;
      let total = subtotal + shipping + tax;

      document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
      document.getElementById("total").textContent = `$${total.toFixed(2)}`;

      document.getElementById("subtotal-input").value = subtotal.toFixed(2);
      document.getElementById("total-input").value = total.toFixed(2);
    }

    document.querySelectorAll(".btn-increase").forEach(btn => {
      btn.addEventListener("click", function () {
      let input = this.closest(".cart-item").querySelector(".quantity-input");
      input.value = parseInt(input.value) + 1;
      updateTotal();
      });
    });

    document.querySelectorAll(".btn-decrease").forEach(btn => {
      btn.addEventListener("click", function () {
      let input = this.closest(".cart-item").querySelector(".quantity-input");
      if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
        updateTotal();
      }
      });
    });

    document.querySelectorAll(".quantity-input").forEach(input => {
      input.addEventListener("keyup", function () {
      if (this.value < 1 || isNaN(this.value)) this.value = 1;
      updateTotal();
      });
    });

    document.querySelectorAll(".btn-remove").forEach(btn => {
      btn.addEventListener("click", function () {
      let item = this.closest(".cart-item");
      item.classList.add("fade-out");
      setTimeout(() => {
        item.remove();
        updateTotal();
      }, 300);
      });
    });

    // حساب الإجمالي عند تحميل الصفحة
    updateTotal();
    });
  </script>


  <style>
    .fade-out {
    opacity: 0;
    transition: opacity 0.3s ease-out;
    }
  </style>

@endsection