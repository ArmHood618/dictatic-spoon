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
  <script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            // hide sidebar
            $('#sidebar').removeClass('active');
            // hide overlay
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            // open sidebar
            $('#sidebar').addClass('active');
            // fade in the overlay
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
  </script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
  {{ session()->forget('alert') }}

  function deleteData(){
    if(confirm('Apakah anda yakin ?')){
      document.findElementById('deleteForm').submit();
    }else{
      return;
    }
  }
  </script>
</head>
<body>
  <div class="wrapper">
  <!-- Navbar Logged - Start -->

  <!--Sidebar - Start-->
  
    <nav id="sidebar">

      <div id="dismiss">
          <i class="fas fa-arrow-left"></i>
      </div>

      <div class="sidebar-header">
          <h3>Menu</h3>
      </div>

      <ul class="list-unstyled components">
          <li>
              <a href="#dataSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-book"></i><span> Data</span></a>
              <ul class="collapse list-unstyled" id="dataSubmenu">
                  <li>
                      <a href="{{ route('owner.pegawai.index') }}">Pegawai</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.supplier.index') }}">Supplier</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.sales.index') }}">Sales</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.merek.index') }}">Merek</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.motor.index') }}">Motor</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.role.index') }}">Role</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.cabang.index') }}">Cabang</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.jasa.index') }}">Jasa</a>
                  </li>
                  <li>
                      <a href="{{ route('owner.sparepart.index') }}">Sparepart</a>
                  </li>
              </ul>
          </li>
          <li>
            <a href="#transaksiSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-cash-register"></i><span> Transaksi</span></a>
              <ul class="collapse list-unstyled" id="transaksiSubmenu">
                <li>
                    <a href="#">Transaksi</a>
                </li>
                <li>
                    <a href="#">Pengadaan Sparepart</a>
                </li>
                <li>
                    <a href="#">Pembayaran</a>
                </li>
              </ul>
          </li>
          <li>
              <a href="#laporanSubmenu" data-toggle="collapse" aria-expanded="false"><i class="far fa-chart-bar"></i><span> Laporan</span></a>
              <ul class="collapse list-unstyled" id="laporanSubmenu">
                  <li>
                      <a href="#">Sparepart Terlaris</a>
                  </li>
                  <li>
                      <a href="#">Pendapatan Bulanan</a>
                  </li>
                  <li>
                      <a href="#">Pendapatan Tahunan</a>
                  </li>
                  <li>
                      <a href="#">Pengeluaran Bulanan</a>
                  </li>
                  <li>
                      <a href="#">Pengeluaran Tahunan</a>
                  </li>
                  <li>
                      <a href="#">Sisa Stok</a>
                  </li>
                  <li>
                      <a href="#">Penjualan Jasa</a>
                  </li>
              </ul>
          </li>
      </ul>
    </nav>
  
  <!--Sidebar - End-->
    <div id="content">
    <div class="overlay"></div>
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1277e1">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-info">
              <i class="fas fa-align-left"></i>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-align-justify"></i>
          </button>
          <div class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('owner.index') }}">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout.process') }}">Keluar</a>
              </li>
            </ul>

            <ul class="navbar-nav my-auto ml-auto">
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Cari Transaksi" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
              </form>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar Logged - End -->

      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 20%;">ID</td>
                <td class="col" style="width: 20%;">Nama</td>
                <td class="col" style="width: 20%;">Supplier</td>
                <td class="col" style="width: 20%;">Nomor Telepon</td>
                <td class="col" style="width: 20%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $sales)
            <tr>
                <th scope="row">{{ $sales->id }}</th>
                <td>{{ $sales->nama }}</td>
                <td>{{ $sales->supplier->nama }}</td>
                <td>{{ $sales->no_telp }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.sales.edit', $sales->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.sales.destroy', $sales->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
                <button type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
                {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td>Not Found !!!</td>
            </tr>
            @endif
          </tbody>
      </table>
      <!-- Table - End -->
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.sales.create') }}"><i class="fas fa-plus"></i><span> Tambah Sales</span></a>
    </div>
    
  </div>
  
</body>
</html>