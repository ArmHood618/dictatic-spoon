<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body onload="createTable()">
  <!-- Navbar - Start -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1277e1">
    <a class="navbar-brand">
    <img src="{{ asset('/image/icon.png') }}" width="30" height="30" alt="Image not Found">
      AtmaAuto
    </a>
    <div class="navbar-collapse collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login.view') }}">Masuk</a>
        </li>
      </ul>

      <ul class="navbar-nav my-auto ml-auto">
      {{ Form::open(array('route' => 'cari', 'method'=>'POST', 'id' => 'form', 'class' => 'form-inline my-2 my-lg-0')) }}
          <input class="form-control mr-sm-2" type="search" placeholder="Cari Transaksi" aria-label="Search" name="cari">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
      {{ Form::close() }}
      </ul>
    </div>
  </nav>
  <!-- Navbar - End -->
  <div class="col-md-12">
            @yield('content')
  </div>
</body>
</html>