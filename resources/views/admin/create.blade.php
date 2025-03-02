@extends('admin.layouts.app')

@section('content')

  @foreach ($errors->all() as $error)
    <div x-danger-button="alert" class="alert alert-danger" role="alert">
    {{ $error }}
    </div>

  @endforeach

  <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">name</label>
      <input type="text" class="form-control" name='name' id="inputEmail4" placeholder="name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Description</label>
      <input type="text" class="form-control" name='description' id="inputPassword4" placeholder="description">
    </div>
    </div>
    <div class="form-group">
    <label for="inputAddress">price</label>
    <input type="number" class="form-control" name='price' id="inputAddress" placeholder="price">
    </div>
    <div class="form-group">
    <label for="inputAddress2">quantity</label>
    <input type="number" class="form-control" name='quantity' id="inputAddress2" placeholder="quantity">
    </div>
    <div class="custom-file">
    <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*">
    <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
@endsection