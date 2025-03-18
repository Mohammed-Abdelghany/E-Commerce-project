@extends('user.layouts.app')
@section('content')

  <div class="latest-products">
    <div class="container">
    <div class="row">
      <!-- عنوان القسم -->
      <div class="col-md-12">
      <div class="section-heading d-flex justify-content-between align-items-center">
        <h2>{{ __('messages.allproducts') }}</h2>
        <a href="{{ url('/allproducts') }}" class="">
        {{ __('messages.View all products') }} <i class="fa fa-angle-right"></i>
        </a>
      </div>
      </div>

      <!-- عرض المنتج -->
      <div class="col-md-6 mx-auto">
      <div class="card product-item shadow-lg border-0">
        <!-- صورة المنتج -->
        <div class="position-relative">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top rounded"
          style="height: 400px; object-fit: cover;">

        <!-- محتوى المنتج -->
        <div class="card-body text-center">
          <h4 class="card-title">

          {{ $product->name }}

          </h4>
          <h5 class="text-primary font-weight-bold">{{ number_format($product->price, 2) }} EGP</h5>
          <p class="text-muted">{{ $product->description }}</p>

          @if ($product->status == 'active')
        <form method="post" action="{{ route('products.cart.add', $product->id) }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">

        <button type="submit" class="btn btn-outline-dark">
        {{ __('messages.Add to cart') }}
        </button>
        </form>

        <div class="mt-2">
        <a href="#" class="btn btn-success btn-lg d-flex align-items-center justify-content-center gap-2">
        <i class="fa fa-shopping-cart"></i> {{ __('messages.Buy now') }}
        </a>
        </div>


      @else
      <div class="mt-3">
      <div
      class="alert alert-danger d-flex align-items-center justify-content-center gap-2 fw-bold animate__animated animate__shakeX"
      role="alert">
      <i class="fa fa-exclamation-triangle"></i> {{ __('messages.Product is not available now') }}
      </div>
      </div>

    @endif



        </div>
        </div>
      </div>

      </div>
    </div>
    </div>

  @endsection