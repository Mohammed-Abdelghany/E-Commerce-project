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

          <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/about') }}">About Us</a>
          </li>

          <li class="nav-item {{ Request::is('cart') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/cart') }}">Cart</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
</header>