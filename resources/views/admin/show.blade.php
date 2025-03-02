@extends('admin.layouts.app')
@section('content')
  <div class="container d-flex justify-content-center mt-4">
    <div class="card bg-dark text-white border-light shadow-lg"
    style="width: 40%; max-width: 400px; border-radius: 15px;">
    <div class="card-body text-center">
      <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid rounded"
      style="max-height: 300px; object-fit: cover;">
    </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table">
    <thead>
      <tr>
      <th>Id</th>
      <th>Name</th>
      <th>quantity</th>
      <th>Price</th>
      <th>Status</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td>{{$product->id}}</td>
      <td>{{$product->name}}</td>
      <td>{{$product->quantity}}</td>
      <td>{{$product->price}}</td>
      <td>
        @if ($product->quantity < 5)
      <label class="badge badge-danger">inactive</label>
    @elseif ($product->quantity > 5)
    <label class="badge badge-success">active</label>
  @endif
      </td>
      <td>
        <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary">Edit</a>
        <form action="{{route('products.destroy', $product->id)}}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>



      </tr>







    </tbody>
    </table>

  </div>
  <div class="d-flex justify-content-center mt-4">
    <a href="{{url('/allproducts')}}" class="btn btn-primary">Back</a>
  </div>





@endsection