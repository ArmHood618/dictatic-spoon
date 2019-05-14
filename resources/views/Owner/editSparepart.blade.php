@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.sparepart.update',$data->id], 'method'=>'PATCH', 'id'=>'formid')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Sparepart :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama Sparepart','class' => 'form-control', 'id' => 'nama','required' => 'required')) !!}
                    <strong>Tipe :</strong>
                    {!! Form::text('tipe',$data->tipe,array('placeholder' => 'Tipe Sparepart','class' => 'form-control', 'id' => 'tipe','required' => 'required')) !!}
                    <strong>Letak :</strong>
                    {!! Form::select('id_letak',$letak,$data->id_letak,array('class' => 'form-control')) !!}
                    <strong>Ruang :</strong>
                    {!! Form::select('id_ruang',$ruang,$data->id_ruang,array('class' => 'form-control')) !!}
                    <strong>Stok Minimal :</strong>
                    {!! Form::number('stok_min',$data->stok_min,array('placeholder' => 'Stok Minimal','class' => 'form-control', 'id' => 'stok_min','required' => 'required')) !!}
                    <strong>Harga Beli :</strong>
                    {!! Form::number('harga_beli',$data->harga_beli,array('placeholder' => 'Harga Beli','class' => 'form-control', 'id' => 'harga_beli','required' => 'required')) !!}
                    <strong>Harga Jual :</strong>
                    {!! Form::number('harga_jual',$data->harga_jual,array('placeholder' => 'Harga Jual','class' => 'form-control', 'id' => 'harga_jual','required' => 'required')) !!}
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                            <strong>Motor yang cocok :</strong>
                            {!! Form::select(null,$motor,null,array('id' => 'select_motor','class' => 'form-control')) !!}
                            <button type="button" class="btn btn-primary" id="add_motor" onclick="addRowMotor()">Tambah</button>
                            <div id="cont_motor" class="table table-bordered"></div>
                            <div id="cont_hidden"></div>
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
        <div id="deleted_items"></div>
      {{ Form::close() }}
      <!-- Form - End -->
      <script>
        // ARRAY FOR HEADER.
        var arrHeadMotor = new Array();
        var arrMotor = new Array();
        var arrMotorSparepart = new Array();
        var arrToDelete = new Array();
        var arrToAdd = new Array();
        arrHeadMotor = ['','Tipe'];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.

        @if($motorAll)
        @foreach($motorAll as $t)
        var obj = {tipe:'{{ $t->tipe }}', id:'{{ $t->id }}'};
        arrMotor.push(obj);
        @endforeach
        @endif

        @if($motorsparepart)
        @foreach($motorsparepart as $t)
        var obj = {tipe:'{{ $t->tipe }}', id:'{{ $t->pivot->id }}', id_motor:'{{ $t->id }}'};
        arrMotorSparepart.push(obj);
        @endforeach
        @endif

        // FIRST CREATE A TABLE STRUCTURE BY ADDING A FEW HEADERS AND
        // ADD THE TABLE TO YOUR WEB PAGE.
        function createTable() {
            var motorTable = document.createElement('table');
            motorTable.setAttribute('id', 'motorTable');            // SET THE TABLE ID.

            var trM = motorTable.insertRow(-1);

            for (var h = 0; h < arrHeadMotor.length; h++) {
                var th = document.createElement('th');          // TABLE HEADER.
                th.innerHTML = arrHeadMotor[h];
                trM.appendChild(th);
            }

            var div = document.getElementById('cont_motor');
            div.appendChild(motorTable);    // ADD THE TABLE TO YOUR WEB PAGE.

            for (var h = 0; h < arrMotorSparepart.length; h++) {
                var tr = motorTable.insertRow(motorTable.rows.length);
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
                        button.setAttribute('id_motor', arrMotorSparepart[h].id);

                        // ADD THE BUTTON's 'onclick' EVENT.
                        button.setAttribute('onclick', 'removeRowExist(this)');

                        td.appendChild(button);

                        
                    }

                    if (c == 1) {
                        td.innerHTML = arrMotorSparepart[h].tipe;
                        
                    }
                }
            }
        }

        

        // ADD A NEW ROW TO THE TABLE.s
        function addRowMotor() {
            var motorTab = document.getElementById('motorTable');
            var motorSelect = document.getElementById('select_motor');
            var hid = document.getElementById('cont_hidden');
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
                    hidden.setAttribute('name', 'add_id_motor[]');
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

        // DELETE TABLE ROW.
        function removeRowExist(oButton) {
            var mtrTab = document.getElementById('motorTable');
            var hidden = document.createElement('input');
            var hid = document.getElementById('cont_hidden');
            //SET ATTRIBUTES
            hidden.setAttribute('name', 'delete_id_motor[]');
            hidden.setAttribute('type', 'hidden');
            hidden.setAttribute('value', oButton.getAttribute('id_motor'));

            hid.appendChild(hidden);
            mtrTab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
        }
    </script>
    </div>
    
  </div>
  
@endsection