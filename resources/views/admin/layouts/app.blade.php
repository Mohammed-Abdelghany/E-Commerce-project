@include('admin.layouts.head')

<body>
  <div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    @include('admin.layouts.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      @include('admin.layouts.navbar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          {{-- main body --}}
          {{-- @include('admin.layouts.body') --}}
          @yield('content')

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layouts.footer')