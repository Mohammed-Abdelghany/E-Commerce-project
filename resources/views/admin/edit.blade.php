@extends('admin.layouts.app')
@section('content')

  <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">name</label>
      <input type="text" class="form-control" name='name' id="inputEmail4" placeholder="name"
      value="{{$product->name}}">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Description</label>
      <input type="text" class="form-control" name='description' id="inputPassword4" placeholder="description"
      value="{{$product->description}}">
    </div>
    </div>
    <div class="form-group">
    <label for="inputAddress">price</label>
    <input type="number" class="form-control" name='price' id="inputAddress" placeholder="price"
      value="{{$product->price}}">
    </div>
    <div class="form-group">
    <label for="inputAddress2">quantity</label>
    <input type="number" class="form-control" name='quantity' id="inputAddress2" placeholder="quantity"
      value="{{$product->quantity}}">
    </div>
    <div class="custom-file">
    <input type="file" class="custom-file-input" name='image' id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
    @if($product->image)
    <div class="mt-2">
      <p>الصورة الحالية:</p>
      <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" width="100">
    </div>
  @endif
    </div>
    <div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

@endsection