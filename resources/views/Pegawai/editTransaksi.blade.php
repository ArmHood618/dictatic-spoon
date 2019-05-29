@extends('layouts.pegawai')
@section('content')
  <!-- Form - Start -->
  {{ Form::open(array('route' => ['owner.transaksi.update',$data->id], 'method'=>'POST', 'id' => 'form')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cabang :</strong>
                    {!! Form::select('id_cabang',$cabang,$data->cabang->id,array('class' => 'form-control')) !!}
                    <strong>Motor :</strong>
                    {!! Form::select('id_motor',$motor,$data->motor->id,array('class' => 'form-control')) !!}
                    <strong>Montir :</strong>
                    {!! Form::select('id_pegawai',$semua_montir,$montir[1]->id,array('class' => 'form-control')) !!}
                    <strong>Nama :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama','class' => 'form-control')) !!}
                    <strong>Nomor Polisi :</strong>
                    {!! Form::text('no_plat',$data->no_plat,array('placeholder' => 'Nomor Polisi','class' => 'form-control')) !!}
                    <strong>Nomor Telepon :</strong>
                    {!! Form::number('no_telp',$data->no_telp,array('placeholder' => 'Nomor Telepon','class' => 'form-control')) !!}
                    <strong>Tanggal Masuk :</strong>
                    {!! Form::date('tanggal',$data->tanggal,array('class' => 'form-control')) !!}
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
                    <div id="cont_hidden"></div>
                </div>
            </div>
            
            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.transaksi.index') }}" class="btn btn-danger">Cancel</a>
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
      <script>
        // ARRAY FOR HEADER.
        var arrHeadJasa = new Array();
        var arrHeadSparepart = new Array();
        var arrJasa = new Array();
        var arrSparepart = new Array();
        var arrJmlJasa = new Array();
        var arrJmlSparepart = new Array();
        var arrDetilSparepart = new Array();
        var arrDetilJasa = new Array();

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

        @if(!empty($detil_sparepart))
        @foreach($detil_sparepart as $data)
            var obj = {nama:'{{ $data->nama }}', harga:{{ $data->harga_jual }}, id:{{ $data->pivot->id }}, jumlah:'{{ $data->pivot->jumlah }}', id_sparepart:{{ $data->id }}};
            arrDetilSparepart.push(obj);
        @endforeach
        @endif

        @if(!empty($detil_jasa))
        @foreach($detil_jasa as $data)
            var obj = {jenis:'{{ $data->jenis }}', harga:{{ $data->harga }}, id:{{ $data->pivot->id }}, jumlah:'{{ $data->pivot->jumlah }}', id_jasa:{{ $data->id }}};
            arrDetilJasa.push(obj);
        @endforeach
        @endif

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

            for(var h = 0; h < arrDetilJasa.length; h++){
                var tr = jasaTable.insertRow(jasaTable.rows.length);
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
                        button.setAttribute('id_jasa', arrDetilJasa[h].id);

                        // ADD THE BUTTON's 'onclick' EVENT.
                        button.setAttribute('onclick', 'removeRowExistJasa(this)');

                        td.appendChild(button);
                    }

                    if (c == 1) {
                        td.innerHTML = arrDetilJasa[h].jenis;
                    }

                    if (c == 2) {
                        td.innerHTML = arrDetilJasa[h].harga;
                    }

                    if (c == 3) {1
                        td.innerHTML = arrDetilJasa[h].jumlah;
                    }
                }
            }
            
            for(var h = 0; h < arrDetilSparepart.length; h++){
                var tr = sparepartTable.insertRow(sparepartTable.rows.length);
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
                        button.setAttribute('id_sparepart', arrDetilSparepart[h].id);

                        // ADD THE BUTTON's 'onclick' EVENT.
                        button.setAttribute('onclick', 'removeRowExistSparepart(this)');

                        td.appendChild(button);
                    }

                    if (c == 1) {
                        td.innerHTML = arrDetilSparepart[h].nama;
                    }

                    if (c == 2) {
                        td.innerHTML = arrDetilSparepart[h].harga;
                    }

                    if (c == 3) {1
                        td.innerHTML = arrDetilSparepart[h].jumlah;
                    }
                }
            }
        }

        // ADD A NEW ROW TO THE TABLE.s
        function addRowJasa() {
            var jasaTab = document.getElementById('jasaTable');
            var jasaSelect = document.getElementById('select_jasa');
            var jasa = arrJasa[jasaSelect.selectedIndex];

            

            var rowCnt = jasaTab.rows.length;        // GET TABLE ROW COUNT.
            for (var i = 1; i<rowCnt; i++){
                
                if(jasaTab.rows[i].cells[1].innerHTML.toString() == jasa.jenis){
                    var jml = document.getElementById('jasa'+i);
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
                    hidden.setAttribute('name', 'add_id_jasa[]');
                    hidden.setAttribute('type', 'hidden');
                    hidden.setAttribute('value', jasa.id);

                    td.appendChild(hidden);

                    // ADD HIDDEN INPUT
                    hidden = document.createElement('input');
                    //SET ATTRIBUTES
                    hidden.setAttribute('name', 'jumlah_jasa[]');
                    hidden.setAttribute('id', 'jasa'+rowCnt);
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
                    var jml = document.getElementById('sparepart'+i);
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
                    hidden.setAttribute('name', 'add_id_sparepart[]');
                    hidden.setAttribute('type', 'hidden');
                    hidden.setAttribute('value', sparepart.id);

                    td.appendChild(hidden);

                    // ADD HIDDEN INPUT
                    hidden = document.createElement('input');
                    //SET ATTRIBUTES
                    hidden.setAttribute('name', 'jumlah_sparepart[]');
                    hidden.setAttribute('type', 'hidden');
                    hidden.setAttribute('id', 'sparepart'+rowCnt);
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

        // DELETE TABLE ROW.
        function removeRowExistJasa(oButton) {
            var Tab = document.getElementById('jasaTable');
            var hidden = document.createElement('input');
            var hid = document.getElementById('cont_hidden');
            //SET ATTRIBUTES
            hidden.setAttribute('name', 'delete_id_jasa[]');
            hidden.setAttribute('type', 'hidden');
            hidden.setAttribute('value', oButton.getAttribute('id_jasa'));

            hid.appendChild(hidden);
            Tab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
        }

        // DELETE TABLE ROW.
        function removeRowExistSparepart(oButton) {
            var Tab = document.getElementById('sparepartTable');
            var hidden = document.createElement('input');
            var hid = document.getElementById('cont_hidden');
            //SET ATTRIBUTES
            hidden.setAttribute('name', 'delete_id_sparepart[]');
            hidden.setAttribute('type', 'hidden');
            hidden.setAttribute('value', oButton.getAttribute('id_sparepart'));

            hid.appendChild(hidden);
            Tab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
        }
    </script>
@endsection