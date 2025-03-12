@extends('user.layouts.app')
@section('content')

  <div class="latest-products">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
      <div class="section-heading">
        <h2>{{__('messages.allproducts')}}</h2>

      </div>
      </div>
      @if(!$products->count() == 0)
      @foreach ($products as $product)


      <div class="col-md-4">
      <div class="product-item">
      <a href="{{ url('show/' . $product->id) }}"><img src="{{ asset('storage/' . $product->image) }}"
      alt="{{ $product->name }}" height="400px" width="100%"></a>
      <div class="down-content">
      <a href="{{ url('show/' . $product->id) }}">
      <h4>{{$product->name}}</h4>
      </a>
      <h6>{{$product->price}}</h6>
      <p>{{ Str::limit($product->description, 20, '......') }}</p>

      {{-- <ul class="stars">
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      <li><i class="fa fa-star"></i></li>
      </ul> --}}
      <small
      class="badge {{$product->status == 'active' ? 'badge-success' : 'badge-danger'  }} ">{{$product->status}}</small>
      @if ($product->status == 'active')
      <form method="post" action="{{ route('products.cart.add', $product->id) }}">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <input type="hidden" name="quantity" value="1">

      <button type="submit" class="btn btn-outline-dark">
      {{ __('messages.Add to cart') }}
      </button>
      </form>
    @endif

      </div>
      </div>
      </div>
    @endforeach
    @else
      <h2>No products found.</h2>
    @endif

      {{ $products->links() }}

    </div>
    </div>
  </div>





@endsection