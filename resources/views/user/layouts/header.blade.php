<header class="">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/home') }}">
        <h2>E-<em>Commerce</em></h2>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/home') }}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          @auth

        <li class="nav-item {{ Request::is('cart') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/cart') }}">Cart</a>
        </li>



      @endauth

          <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/contact') }}">Contact US</a>
          </li>

          @auth
        <li class="nav-item {{ Request::is('logout') ? 'active' : '' }}">
        <a class="nav-link" href="#"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="post" type="hidden">
          @csrf
        </form>

    @endauth
            @guest
          <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/login') }}">Login</a>


      @endguest

          </li>


        </ul>
      </div>

    </div>
  </nav>
</header>