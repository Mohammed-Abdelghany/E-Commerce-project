@extends('admin.layouts.app')
@section('content')


  <div class="page-header">

    <h3 class="page-title"> Basic Tables </h3>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
    </ol>
    </nav>
  </div>
  <div class="row" style="margin-left: 20%;width: 100%">
    <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <h4 class="card-title">Products Table</h4>
      </p>
      <div class="table-responsive">
        <table class="table">
        <thead>
          <tr>

          <th>

            {{ __('messages.id')}}
          </th>
          <th>{{__('messages.Name')}}</th>
          <th>{{__('messages.Quantity')}}</th>
          <th>{{__('messages.status')}}</th>
          <th>{{__('messages.Image')}}</th>
          <th>{{__('messages.Actions')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
        <tr>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->quantity}}</td>


        @if ($product->quantity < 5)
      <td><label class="badge badge-danger">{{__('messages.inactive')}}</label></td>
    @elseif ($product->quantity > 5)
    <td><label class="badge badge-success">{{__('messages.active')}}</label></td>
  @endif

        <td><img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="300px"></td>
        <td>
        <a href="{{url('/show' . '/' . $product->id)}}" class="btn btn-primary">{{__('messages.Show')}}</a>
        </td>



      @endforeach 

          </tr>
          <tr>
          <td colspan="5" class="text-center">
            <a style="margin-left: 20%" href="{{url('/create')}}"
            class="btn btn-primary">{{__('messages.Create Product')}}</a>
          </td>
          </tr>
        </tbody>
        </table>

      </div>
      </div>
    </div>
    </div>
  </div>

  <div class="pagination" style="margin-left: 40%">
    {{$products->links()}}
  </div>




  {{--
  </div>
  </div>
  </div>
  </div>
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
      <h4 class="card-title">Hoverable Table</h4>
      <p class="card-description"> Add class <code>.table-hover</code>
      </p>
      <div class="table-responsive">
      <table class="table table-hover">
        <thead>
        <tr>
          <th>User</th>
          <th>Product</th>
          <th>Sale</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Jacob</td>
          <td>Photoshop</td>
          <td class="text-danger"> 28.76% <i class="mdi mdi-arrow-down"></i></td>
          <td><label class="badge badge-danger">Pending</label></td>
        </tr>
        <tr>
          <td>Messsy</td>
          <td>Flash</td>
          <td class="text-danger"> 21.06% <i class="mdi mdi-arrow-down"></i></td>
          <td><label class="badge badge-warning">In progress</label></td>
        </tr>
        <tr>
          <td>John</td>
          <td>Premier</td>
          <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i></td>
          <td><label class="badge badge-info">Fixed</label></td>
        </tr>
        <tr>
          <td>Peter</td>
          <td>After effects</td>
          <td class="text-success"> 82.00% <i class="mdi mdi-arrow-up"></i></td>
          <td><label class="badge badge-success">Completed</label></td>
        </tr>
        <tr>
          <td>Dave</td>
          <td>53275535</td>
          <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
          <td><label class="badge badge-warning">In progress</label></td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
    </div>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
      <h4 class="card-title">Striped Table</h4>
      <p class="card-description"> Add class <code>.table-striped</code>
      </p>
      <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th> User </th>
          <th> First name </th>
          <th> Progress </th>
          <th> Amount </th>
          <th> Deadline </th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
          </td>
          <td> Herman Beck </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $ 77.99 </td>
          <td> May 15, 2015 </td>
        </tr>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-2.png" alt="image" />
          </td>
          <td> Messsy Adam </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $245.30 </td>
          <td> July 1, 2015 </td>
        </tr>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-3.png" alt="image" />
          </td>
          <td> John Richards </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $138.00 </td>
          <td> Apr 12, 2015 </td>
        </tr>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-4.png" alt="image" />
          </td>
          <td> Peter Meggik </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $ 77.99 </td>
          <td> May 15, 2015 </td>
        </tr>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
          </td>
          <td> Edward </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $ 160.25 </td>
          <td> May 03, 2015 </td>
        </tr>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-2.png" alt="image" />
          </td>
          <td> John Doe </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $ 123.21 </td>
          <td> April 05, 2015 </td>
        </tr>
        <tr>
          <td class="py-1">
          <img src="../../assets/images/faces-clipart/pic-3.png" alt="image" />
          </td>
          <td> Henry Tom </td>
          <td>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </td>
          <td> $ 150.00 </td>
          <td> June 16, 2015 </td>
        </tr>
        </tbody>
      </table>
      </div>
    </div>
    </div>
  </div> --}}

  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->

@endsection