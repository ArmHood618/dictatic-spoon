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
    // ARRAY FOR HEADER.
    var arrHeadMotor = new Array();
    var arrMotor = new Array();
    var arrMotorSparepart = new Array();
    arrHeadMotor = ['','Tipe'];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.

    @if($motorAll)
    @foreach($motorAll as $t)
        var obj = {tipe:'{{ $t->tipe }}', id:'{{ $t->id }}'};
        arrMotor.push(obj);
    @endforeach
    @endif

    @if($motorsparepart)
    @foreach($motorsparepart as $t)
        var obj = {id_motor:'{{ $t->id_motor }}', id:'{{ $t->id }}', id_sparepart:'{{ $t->id_sparepart }}'};
        arrMotorSparepart.push(obj);
    @endforeach
    @endif

    // FIRST CREATE A TABLE STRUCTURE BY ADDING A FEW HEADERS AND
    // ADD THE TABLE TO YOUR WEB PAGE.
    function createTable() {
        var motorTable = document.createElement('table');
        motorTable.setAttribute('id', 'motorTable');            // SET THE TABLE ID.

        var trM = motorTable.insertRow(-1);

        for (var i = 0; i < arrHeadMotor.length; i++) {
            var th = document.createElement('th');          // TABLE HEADER.
            th.innerHTML = arrHeadMotor[i];
            trM.appendChild(th);
        }

        var div = document.getElementById('cont_motor');
        div.appendChild(motorTable);    // ADD THE TABLE TO YOUR WEB PAGE.
        //motorTable = document.getElementById('motorTable');
        if(motorTable){
            for (var i = 1; i < arrMotorSparepart.length + 2; i++){
                var tr = motorTable.insertRow(i);      // TABLE ROW.
                
                for (var c = 0; c < arrHeadMotor.length; c++) {
                    var td = document.createElement('td');          // TABLE DEFINITION.
                    var motor = findIdfromMotor(arrMotorSparepart[i-1].id_motor);
                    
                    td = tr.insertCell(c);

                    if (c == 0) {           // FIRST COLUMN.
                        // ADD A BUTTON.
                        var button = document.createElement('input');

                        // SET INPUT ATTRIBUTE.
                        button.setAttribute('type', 'button');
                        button.setAttribute('value', 'Remove');
                        button.setAttribute('class', 'btn btn-outline-dark my-2 my-sm-0');

                        // ADD THE BUTTON's 'onclick' EVENT.
                        button.setAttribute('onclick', 'removeRow(this)');

                        td.appendChild(button);

                        // ADD HIDDEN INPUT
                        var hidden = document.createElement('input');
                        //SET ATTRIBUTES
                        hidden.setAttribute('name', 'id_motor[]');
                        hidden.setAttribute('type', 'hidden');
                        hidden.setAttribute('value', motor.id);

                        td.appendChild(hidden);
                    }

                    if (c == 1) {
                        td.innerHTML = motor.tipe;
                    }
                }
            }
        }
        
    }

    function findIdfromMotor(id){
        for(var i = 0; i < arrMotor.length; i++){
            if(arrMotor[i].id == id){
                return arrMotor[i];
            }
        }
        return null;
    }
    

    // ADD A NEW ROW TO THE TABLE.s
    function addRowMotor() {
        var motorTab = document.getElementById('motorTable');
        var motorSelect = document.getElementById('select_motor');
        var motor = arrMotor[motorSelect.selectedIndex];

        var rowCnt = motorTab.rows.length;        // GET TABLE ROW COUNT.
        
        for (var i = 1; i<rowCnt; i++){
            if(motorTab.rows[i].cells[1].innerHTML.toString() == motor.tipe){
                return;
            }
        }
        var tr = motorTab.insertRow(rowCnt);      // TABLE ROW.

        for (var c = 0; c < arrHeadMotor.length; c++) {
            var td = document.createElement('td');          // TABLE DEFINITION.
            td = tr.insertCell(c);

            if (c == 0) {           // FIRST COLUMN.
                // ADD A BUTTON.
                var button = document.createElement('input');

                // SET INPUT ATTRIBUTE.
                button.setAttribute('type', 'button');
                button.setAttribute('value', 'Remove');
                button.setAttribute('class', 'btn btn-outline-dark my-2 my-sm-0');

                // ADD THE BUTTON's 'onclick' EVENT.
                button.setAttribute('onclick', 'removeRow(this)');

                td.appendChild(button);

                // ADD HIDDEN INPUT
                var hidden = document.createElement('input');
                //SET ATTRIBUTES
                hidden.setAttribute('name', 'id_motor[]');
                hidden.setAttribute('type', 'hidden');
                hidden.setAttribute('value', motor.id);

                td.appendChild(hidden);
            }

            if (c == 1) {
                td.innerHTML = motor.tipe;
                
            }
        }
    }

    // DELETE TABLE ROW.
    function removeRow(oButton) {
        var mtrTab = document.getElementById('motorTable');
        mtrTab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
    }
   </script>
</head>
<body onload="createTable()">
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

      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.sparepart.update',$data->id], 'method'=>'PATCH')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Sparepart :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama Sparepart','class' => 'form-control')) !!}
                    <strong>Tipe :</strong>
                    {!! Form::text('tipe',$data->tipe,array('placeholder' => 'Tipe Sparepart','class' => 'form-control')) !!}
                    <strong>Letak :</strong>
                    {!! Form::select('id_letak',$letak,$data->id_letak,array('class' => 'form-control')) !!}
                    <strong>Ruang :</strong>
                    {!! Form::select('id_ruang',$ruang,$data->id_ruang,array('class' => 'form-control')) !!}
                    <strong>Stok Minimal :</strong>
                    {!! Form::text('stok_min',$data->stok_min,array('placeholder' => 'Stok Minimal','class' => 'form-control')) !!}
                    <strong>Harga Beli :</strong>
                    {!! Form::number('harga_beli',$data->harga_beli,array('placeholder' => 'Harga Beli','class' => 'form-control')) !!}
                    <strong>Harga Jual :</strong>
                    {!! Form::number('harga_jual',$data->harga_jual,array('placeholder' => 'Harga Jual','class' => 'form-control')) !!}
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                            <strong>Motor yang cocok :</strong>
                            {!! Form::select(null,$motor,null,array('id' => 'select_motor','class' => 'form-control')) !!}
                            <button type="button" class="btn btn-primary" id="add_motor" onclick="addRowMotor()">Tambah</button>
                            <div id="cont_motor" class="table table-bordered"></div>
                    </div>
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.sparepart.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </td>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </td>
            </table>
        </div>
      {{ Form::close() }}
      <!-- Form - End -->
    </div>
    
  </div>
  
</body>
</html>