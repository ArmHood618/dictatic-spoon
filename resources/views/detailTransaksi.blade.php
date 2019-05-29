@extends('layouts.home')
@section('content')
<?php $total = 0; ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cabang :</strong>
            {{ $data->cabang->daerah }}
            <br>
            <strong>Motor :</strong>
            {{ $data->motor->tipe }}
            <br>
            <strong>Montir :</strong>
            {{ $montir[1]->nama }}
            <br>
            <strong>Nama :</strong>
            {{ $data->nama }}
            <br>
            <strong>Nomor Polisi :</strong>
            {{ $data->no_plat }}
            <br>
            <strong>Nomor Telepon :</strong>
            {{ $data->no_telp }}
            <br>
            <strong>Tanggal Masuk :</strong>
            {{ $data->tanggal }}
            <br>
        </div>
        <div class="row">
            @if($data->sparepart->count())
            <div class="col-xs-12 col-md-6">
                    <strong>Sparepart :</strong>
                    <div id="cont_sparepart" class="table table-bordered"></div>
            </div>
            @endif
            @if($data->jasa->count())
            <div class="col-xs-12 col-md-6">
                    <strong>Jasa :</strong>
                    <div id="cont_jasa" class="table table-bordered"></div>
            </div>
            @endif
        </div>
        <strong>Total : </strong>
    
<script>
        // ARRAY FOR HEADER.
        var arrHeadJasa = new Array();
        var arrHeadSparepart = new Array();
        var arrDetilSparepart = new Array();
        var arrDetilJasa = new Array();

        arrHeadJasa = ['Jenis', 'Harga', 'Jumlah'];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.
        arrHeadSparepart = ['Nama', 'Harga', 'Jumlah'];

        @if($detil_sparepart->count())
        @foreach($detil_sparepart as $data)
            var obj = {nama:'{{ $data->nama }}', harga:{{ $data->harga_jual }}, id:{{ $data->pivot->id }}, jumlah:'{{ $data->pivot->jumlah }}', id_sparepart:{{ $data->id }}};
            arrDetilSparepart.push(obj);
            <?php $total += $data->harga_jual * $data->pivot->jumlah;?>
        @endforeach
        @endif

        @if($detil_jasa->count())
        @foreach($detil_jasa as $data)
            var obj = {jenis:'{{ $data->jenis }}', harga:{{ $data->harga }}, id:{{ $data->pivot->id }}, jumlah:'{{ $data->pivot->jumlah }}', id_jasa:{{ $data->id }}};
            arrDetilJasa.push(obj);
            <?php $total += $data->harga * $data->pivot->jumlah;?>
        @endforeach
        @endif

        // FIRST CREATE A TABLE STRUCTURE BY ADDING A FEW HEADERS AND
        // ADD THE TABLE TO YOUR WEB PAGE.
        function createTable() {
            @if($detil_jasa->count())
            var jasaTable = document.createElement('table');
            jasaTable.setAttribute('id', 'jasaTable');            // SET THE TABLE ID.
            var trJ = jasaTable.insertRow(-1);

            for (var h = 0; h < arrHeadJasa.length; h++) {
                var th = document.createElement('th');          // TABLE HEADER.
                th.innerHTML = arrHeadJasa[h];
                trJ.appendChild(th);
            }
            @endif

            @if($detil_sparepart->count())
            var sparepartTable = document.createElement('table');
            sparepartTable.setAttribute('id', 'sparepartTable');
            var trS = sparepartTable.insertRow(-1);

            for (var h = 0; h < arrHeadSparepart.length; h++) {
                var th = document.createElement('th');          // TABLE HEADER.
                th.innerHTML = arrHeadSparepart[h];
                trS.appendChild(th);
            }
            @endif

            var div = document.getElementById('cont_jasa');
            @if($detil_jasa->count())
            div.appendChild(jasaTable);    // ADD THE TABLE TO YOUR WEB PAGE.
            @endif

            var div = document.getElementById('cont_sparepart');
            @if($detil_sparepart->count())
            div.appendChild(sparepartTable);
            @endif

            for(var h = 0; h < arrDetilJasa.length; h++){
                var tr = jasaTable.insertRow(jasaTable.rows.length);
                for (var c = 0; c < arrHeadJasa.length; c++) {
                    var td = document.createElement('td');          // TABLE DEFINITION.
                    td = tr.insertCell(c);

                    if (c == 0) {
                        td.innerHTML = arrDetilJasa[h].jenis;
                    }

                    if (c == 1) {
                        td.innerHTML = arrDetilJasa[h].harga;
                    }

                    if (c == 2) {1
                        td.innerHTML = arrDetilJasa[h].jumlah;
                    }
                }
            }
            
            for(var h = 0; h < arrDetilSparepart.length; h++){
                var tr = sparepartTable.insertRow(sparepartTable.rows.length);
                for (var c = 0; c < arrHeadSparepart.length; c++) {
                    var td = document.createElement('td');          // TABLE DEFINITION.
                    td = tr.insertCell(c);

                    if (c == 0) {
                        td.innerHTML = arrDetilSparepart[h].nama;
                    }

                    if (c == 1) {
                        td.innerHTML = arrDetilSparepart[h].harga;
                    }

                    if (c == 2) {1
                        td.innerHTML = arrDetilSparepart[h].jumlah;
                    }
                }
            }
        }
</script>
    {{ $total }}
    </div>
    <div class="text-center">
        <a href="{{ route('owner.sparepart.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</div>
@endsection