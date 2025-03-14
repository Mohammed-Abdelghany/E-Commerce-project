@extends('admin.layouts.app')


@if (session('error'))
  <div style="margin: 20px;" class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
@endif
@section('content')


  <div class="table-responsive">
    <table class="table">
    <thead>
      <tr>
      <th>Id</th>
      <th>Created At</th>
      <th>Updated At</th>
      <th>User Name</th>
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Action</th>

      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
      <td>{{$order->id}}</td>
      <td>{{$order->created_at}}</td>
      <td>{{$order->updated_at}}</td>
      <td>{{$order->user->name}}</td>
      <td>{{$order->product_id}}</td>
      <td>{{$order->product->name}}</td>
      <td>{{$order->quantity}}</td>
      <td>{{$order->total_price}}</td>
      <td>{{$order->status }} </td>


      <td>

      <form action="{{ route('orders.delete', $order->id) }}" method="POST" style="display: inline-block;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
      </form>

      </tr>
    @endforeach


    </tbody>
    </table>

  </div>
  <div class="pagination" style="margin-left:40%;padding-top: 20px;">
    {{$orders->links()}}
  </div>

  @if (session('success'))
    <div style="margin: 20px;" class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
  @endif





@endsection