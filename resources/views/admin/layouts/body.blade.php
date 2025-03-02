<div class="row ">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Order Status</h4>
        <div class="table-responsive">
          @php $i = ($users->currentPage() - 1) * $users->perPage() + 1; @endphp
          @if (session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
      @elseif(session('error'))
      <div class="alert alert-danger">
      {{ session('error') }}

  @endif
            <table class="table">
              <thead>
                <tr>
                  </th>
                  <th> {{{__('messages.id')}}} </th>
                  <th> {{{__('messages.Image')}}} </th>
                  <th> {{{__('messages.Name')}}} </th>
                  <th> {{{__('messages.Email')}}} </th>
                  <th> {{__('messages.Role')}} </th>
                  <th> {{{__('messages.Actions')}}} </th>
                </tr>
              </thead>
              <tbody>

                @foreach($users as $user)
          <tr>


            </td>
            <td>{{$i++}}</td>

            <td>
            <img src="{{asset($user->profile_photo_path)}}" alt="image" />

            </td>
            <td>{{$user->name}} </td>
            <td> {{$user->email}}</td>
            <td>{{$user->role == 1 ? __('messages.Admin') : __('messages.User') }}</td>

            <td>

            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
              onsubmit="return confirm({{__('messages.Are you sure you want to delete this user?')}});">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>

            </td>
          </tr>

        @endforeach
              <tfoot>
                <tr>
                  <td colspan=" 6">
                    <div class="d-flex justify-content-center">
                      {{$users->links()}}
                    </div>
                  </td>
                </tr>
                </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>