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
  </script>
  <script>
    // ARRAY FOR HEADER.
    var arrHeadJasa = new Array();
    var arrHeadSparepart = new Array();
    var arrJasa = new Array();
    var arrSparepart = new Array();
    var arrJmlJasa = new Array();
    var arrJmlSparepart = new Array();
    arrHeadJasa = ['','Jenis', 'Harga', 'Jumlah'];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.
    arrHeadSparepart = ['', 'Nama', 'Harga', 'Jumlah'];
    @foreach($semua_jasa as $data)
        var obj = {jenis:'{{ $data->jenis }}', id:{{ $data->id }}, harga:{{ $data->harga }}};
        arrJasa.push(obj);
    @endforeach

    @foreach($semua_sparepart as $data)
        var obj = {nama:'{{ $data->nama }}', id:{{ $data->id }}, harga:{{ $data->harga_jual }}};
        arrSparepart.push(obj);
    @endforeach

    // FIRST CREATE A TABLE STRUCTURE BY ADDING A FEW HEADERS AND
    // ADD THE TABLE TO YOUR WEB PAGE.
    function createTable() {
        var jasaTable = document.createElement('table');
        var sparepartTable = document.createElement('table');
        jasaTable.setAttribute('id', 'jasaTable');            // SET THE TABLE ID.
        sparepartTable.setAttribute('id', 'sparepartTable');

        var trJ = jasaTable.insertRow(-1);
        var trS = sparepartTable.insertRow(-1);

        for (var h = 0; h < arrHeadJasa.length; h++) {
            var th = document.createElement('th');          // TABLE HEADER.
            th.innerHTML = arrHeadJasa[h];
            trJ.appendChild(th);
        }

        for (var h = 0; h < arrHeadSparepart.length; h++) {
            var th = document.createElement('th');          // TABLE HEADER.
            th.innerHTML = arrHeadSparepart[h];
            trS.appendChild(th);
        }

        var div = document.getElementById('cont_jasa');
        div.appendChild(jasaTable);    // ADD THE TABLE TO YOUR WEB PAGE.
        div = document.getElementById('cont_sparepart');
        div.appendChild(sparepartTable);
    }

    // ADD A NEW ROW TO THE TABLE.s
    function addRowJasa() {
        var jasaTab = document.getElementById('jasaTable');
        var jasaSelect = document.getElementById('select_jasa');
        var jasa = arrJasa[jasaSelect.selectedIndex];

        

        var rowCnt = jasaTab.rows.length;        // GET TABLE ROW COUNT.
        for (var i = 1; i<rowCnt; i++){
            
            if(jasaTab.rows[i].cells[1].innerHTML.toString() == jasa.jenis){
                var jml = document.getElementsByName('jumlah_jasa[]');
                var tmp = 1 + parseInt(jasaTab.rows[i].cells[3].innerHTML);
                jasaTab.rows[i].cells[3].innerHTML = tmp;
                jml.value = tmp;
                return;
            }

        }

        var tr = jasaTab.insertRow(rowCnt);      // TABLE ROW.

        for (var c = 0; c < arrHeadJasa.length; c++) {
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
                button.setAttribute('onclick', 'removeRowJasa(this)');

                td.appendChild(button);

                // ADD HIDDEN INPUT
                var hidden = document.createElement('input');
                //SET ATTRIBUTES
                hidden.setAttribute('name', 'id_jasa[]');
                hidden.setAttribute('type', 'hidden');
                hidden.setAttribute('value', jasa.id);

                td.appendChild(hidden);

                // ADD HIDDEN INPUT
                hidden = document.createElement('input');
                //SET ATTRIBUTES
                hidden.setAttribute('name', 'jumlah_jasa[]');
                hidden.setAttribute('type', 'hidden');
                hidden.setAttribute('value', '1');

                td.appendChild(hidden);
            }

            if (c == 1) {
                td.innerHTML = jasa.jenis;
            }

            if (c == 2) {
                td.innerHTML = jasa.harga;
            }

            if (c == 3) {
                td.innerHTML = 1;
            }
        }
    }

    function addRowSparepart() {
        var sparepartTab = document.getElementById('sparepartTable');
        var sparepartSelect = document.getElementById('select_sparepart');
        var sparepart = arrSparepart[sparepartSelect.selectedIndex];

        

        var rowCnt = sparepartTab.rows.length;        // GET TABLE ROW COUNT.
        for (var i = 1; i<rowCnt; i++){
            
            if(sparepartTab.rows[i].cells[1].innerHTML.toString() == sparepart.nama){
                var tmp = 1 + parseInt(sparepartTab.rows[i].cells[3].innerHTML);
                sparepartTab.rows[i].cells[3].innerHTML = tmp;
                var jml = document.getElementsByName('jumlah_sparepart[]');
                jml.value = tmp;
                return;
            }
        }
        var tr = sparepartTab.insertRow(rowCnt);      // TABLE ROW.

        for (var c = 0; c < arrHeadSparepart.length; c++) {
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
                button.setAttribute('onclick', 'removeRowSparepart(this)');

                td.appendChild(button);

                // ADD HIDDEN INPUT
                var hidden = document.createElement('input');
                //SET ATTRIBUTES
                hidden.setAttribute('name', 'id_sparepart[]');
                hidden.setAttribute('type', 'hidden');
                hidden.setAttribute('value', sparepart.id);

                td.appendChild(hidden);

                // ADD HIDDEN INPUT
                hidden = document.createElement('input');
                //SET ATTRIBUTES
                hidden.setAttribute('name', 'jumlah_sparepart[]');
                hidden.setAttribute('type', 'hidden');
                hidden.setAttribute('value', 1);

                td.appendChild(hidden);
            }

            if (c == 1) {
                td.innerHTML = sparepart.nama;
            }

            if (c == 2) {
                td.innerHTML = sparepart.harga;
            }

            if (c == 3) {
                td.innerHTML = 1;
            }
        }
    }


    // DELETE TABLE ROW.
    function removeRowJasa(oButton) {
        var empTab = document.getElementById('jasaTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
    }

    function removeRowSparepart(oButton) {
        var empTab = document.getElementById('sparepartTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
    }
</script>
</head>
<body onload="createTable()">
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
      <a href="#transaksiSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-cash-register"></i><span> Transaksi</span></a>
        <ul class="collapse list-unstyled" id="transaksiSubmenu">
          <li>
              <a href="#">Transaksi</a>
          </li>
          <li>
              <a href="#">Pembayaran</a>
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
          <a class="nav-link" href="{{ route('pegawai.index') }}">Beranda</a>
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
  {{ Form::open(array('route' => 'owner.transaksi.store', 'method'=>'POST', 'id' => 'form')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cabang :</strong>
                    {!! Form::select('id_cabang',$cabang,null,array('class' => 'form-control')) !!}
                    <strong>Motor :</strong>
                    {!! Form::select('id_motor',$motor,null,array('class' => 'form-control')) !!}
                    <strong>Nama :</strong>
                    {!! Form::text('alamat',null,array('placeholder' => 'Nama','class' => 'form-control')) !!}
                    <strong>Nomor Polisi :</strong>
                    {!! Form::text('no_plat',null,array('placeholder' => 'Nomor Polisi','class' => 'form-control')) !!}
                    <strong>Nomor Telepon :</strong>
                    {!! Form::number('no_telp',null,array('placeholder' => 'Nomor Telepon','class' => 'form-control')) !!}
                    <strong>Tanggal Masuk :</strong>
                    {!! Form::date('tanggal',null,array('class' => 'form-control')) !!}
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                            <strong>Sparepart :</strong>
                            {!! Form::select(null,$sparepart,null,array('id' => 'select_sparepart','class' => 'form-control')) !!}
                            <button type="button" class="btn btn-primary" id="add_sparepart" onclick="addRowSparepart()">Tambah</button>
                            <div id="cont_sparepart" class="table table-bordered"></div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                            <strong>Jasa :</strong>
                            {!! Form::select(null,$jasa,null,array('id' => 'select_jasa','class' => 'form-control')) !!}
                            <button type="button" class="btn btn-primary" id="add_jasa" onclick="addRowJasa()">Tambah</button>
                            <div id="cont_jasa" class="table table-bordered"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      {{ Form::close() }}
      <!-- Form - End -->
</body>
</html>