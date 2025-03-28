@extends('user.layouts.app')
@section('content')
  @if (session('success'))
    <div style="margin: 20px;" class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div style="margin: 20px;" class="alert alert-danger" role="alert">
    {{ session('error') }}
    </div>
  @endif

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
      <a href="{{ route('products.show', $product->id) }}"><img src="{{ asset('storage/' . $product->image) }}"
      alt="{{ $product->name }}" height="400px" width="100%"></a>
      <div class="down-content">
      <a href="{{ route('products.show', $product->id) }}">
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


    </div>
    </div>
  </div>

  <div style="padding-left:47%">{{ $products->links() }}</div>





@endsection