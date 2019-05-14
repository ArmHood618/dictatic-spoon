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
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
</head>
<body>
  <!-- Navbar - Start -->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1277e1">
    <a class="navbar-brand">
    <img src="/image/icon.png" width="30" height="30" alt="Image not Found">
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
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Cari Transaksi" aria-label="Search">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
        </form>
      </ul>
    </div>
  </nav>
  <!-- Navbar - End -->

  <!-- Grid - Start -->
  <div class="row ml-3">

    <div class="col-sm-0 mr-3">
      <div class="card my-3" style="width: 18rem;">
        <img src="/image/imagenotfound.png" class="card-img-top" style="width: 18rem;height: 18rem;" alt="/image/imagenotfound.png">
        <div class="card-body">
          <h5 class="card-title">Sample Grid</h5>
          <p class="card-text">Some quick example text.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <!-- Divider -->
    <div class="col-sm-0 mr-3">
      <div class="card my-3" style="width: 18rem;">
        <img src="/image/imagenotfound.png" class="card-img-top" style="width: 18rem;height: 18rem;" alt="/image/imagenotfound.png">
        <div class="card-body">
          <h5 class="card-title">Sample Grid</h5>
          <p class="card-text">Some quick example text.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>

  </div>

  <div class="row ml-3">

    <div class="col-sm-0 mr-3">
      <div class="card my-3" style="width: 18rem;">
        <img src="/image/imagenotfound.png" class="card-img-top" style="width: 18rem;height: 18rem;" alt="/image/imagenotfound.png">
        <div class="card-body">
          <h5 class="card-title">Sample Grid</h5>
          <p class="card-text">Some quick example text.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <!-- Divider -->
    <div class="col-sm-0 mr-3">
      <div class="card my-3" style="width: 18rem;">
        <img src="/image/imagenotfound.png" class="card-img-top" style="width: 18rem;height: 18rem;" alt="/image/imagenotfound.png">
        <div class="card-body">
          <h5 class="card-title">Sample Grid</h5>
          <p class="card-text">Some quick example text.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    
  </div>
  <!-- Grid - End -->
  <script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
  {{ session()->forget('alert') }}
  </script>
</body>
</html>