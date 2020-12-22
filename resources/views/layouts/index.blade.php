<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'ILocker') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex align-items-center">
      <h1 class="logo mr-auto"><a href="{{ url('/') }}">ImageLocker<span>.</span></a></h1>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li> <a href="{{ url('/') }}">Home</a></li> @auth
          <li><a href="{{url('ajaxupdate/'.Auth::user()->id)}}">My Uploads</a></li> @endauth @guest @if (Route::has('login'))
          <li> <a href="{{ route('login') }}">{{ __('Login') }}</a></li> @endif @if (Route::has('register'))
          <li> <a href="{{ route('register') }}">{{ __('Register') }}</a></li> @endif @else
          <li> <a href="#" role="button">
                                      {{ Auth::user()->name }}
                                  </a></li>
          <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form> @endguest </ul>
      </nav>
    </div>
  </header>
  <!-- End Header -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container aos-init aos-animate" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to       
        <span>
          ImageLocker
        </span>
      </h1>
      <h2>Store your images safe and sound here</h2>
      <div class="d-flex"> @guest <a href="{{ route('login') }}" class="btn-get-started scrollto">Login</a> &nbsp;&nbsp;&nbsp; <a href="{{ route('register') }}" class="btn-get-started scrollto">Register</a> @endguest </div>
    </div>
  </section>
  <main id="main">@yield('content') </main>
  <!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container py-4">
      <div class="copyright"> &copy; Copyright <a href="https://jeevanism.com"><strong><span>Jeevan</span></strong></a> All Rights Reserved </div>
      <div class="credits">
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0"> Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>