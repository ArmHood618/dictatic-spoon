@extends('layouts.owner')
@section('content')
<!-- Form - Start -->
{{ Form::open(array('route' => 'owner.pengadaan.store', 'method'=>'POST')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Supplier :</strong>
                    {!! Form::select('id_supplier',$supplier,null,array('class' => 'form-control')) !!}
                    <strong>Tanggal Pesan :</strong>
                    {!! Form::date('tanggal',null,array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="row">
                    <div class="col-xs-12 col-md-6">
                            <strong>Sparepart :</strong>
                            {!! Form::select(null,$sparepart,null,array('id' => 'select_sparepart','class' => 'form-control')) !!}
                            <button type="button" class="btn btn-primary" id="add_sparepart" onclick="addRowSparepart()">Tambah</button>
                            <div id="cont_sparepart" class="table table-bordered"></div>
                    </div>
            </div>
            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.pengadaan.index') }}" class="btn btn-danger">Cancel</a>
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
  <script>
        // ARRAY FOR HEADER.
        var arrHeadSparepart = new Array();
        var arrSparepart = new Array();
        var arrJmlSparepart = new Array();
              // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.
        arrHeadSparepart = ['', 'Nama', 'Harga', 'Jumlah'];

        @foreach($semua_sparepart as $data)
            var obj = {nama:'{{ $data->nama }}', id:{{ $data->id }}, harga:{{ $data->harga_jual }}};
            arrSparepart.pus h(obj);
        @endforeach

        // FIRST CREATE A TABLE STRUCTURE BY ADDING A FEW HEADERS AND
        // ADD THE TABLE TO YOUR WEB PAGE.
        function createTable() {
            var sparepartTable = document.createElement('table');
            // SET THE TABLE ID.
            sparepartTable.setAttribute('id', 'sparepartTable');

            var trS = sparepartTable.insertRow(-1);

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

        // ADD A NEW ROW TO THE TABLE.
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

        function removeRowSparepart(oButton) {
            var empTab = document.getElementById('sparepartTable');
            empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
        }
    </script>
@endsection