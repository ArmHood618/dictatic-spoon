@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => 'owner.sparepart.store', 'method'=>'POST', 'id' => 'formid')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Nama Sparepart :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama Sparepart','class' => 'form-control', 'id' => 'nama')) !!}
                    <strong>Tipe :</strong>
                    {!! Form::text('tipe',$data->tipe,array('placeholder' => 'Tipe Sparepart','class' => 'form-control', 'id' => 'tipe')) !!}
                    <strong>Letak :</strong>
                    {!! Form::select('id_letak',$letak,$data->id_letak,array('class' => 'form-control')) !!}
                    <strong>Ruang :</strong>
                    {!! Form::select('id_ruang',$ruang,$data->id_ruang,array('class' => 'form-control')) !!}
                    <strong>Stok Minimal :</strong>
                    {!! Form::number('stok_min',$data->stok_min,array('placeholder' => 'Stok Minimal','class' => 'form-control', 'id' => 'stok_min')) !!}
                    <strong>Harga Beli :</strong>
                    {!! Form::number('harga_beli',$data->harga_beli,array('placeholder' => 'Harga Beli','class' => 'form-control', 'id' => 'harga_beli')) !!}
                    <strong>Harga Jual :</strong>
                    {!! Form::number('harga_jual',$data->harga_jual,array('placeholder' => 'Harga Jual','class' => 'form-control', 'id' => 'harga_jual')) !!}
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
                            <button type="button" onclick="submitForm()" class="btn btn-primary">Submit</button>
                        </div>
                    </td>
            </table>
        </div>
      {{ Form::close() }}
      <!-- Form - End -->
      <script>
    // ARRAY FOR HEADER.
    var arrHeadMotor = new Array();
    var arrMotor = new Array();
    arrHeadMotor = ['','Tipe'];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.

    @if($motorAll)
    @foreach($motorAll as $data)
        var obj = {tipe:'{{ $data->tipe }}', id:'{{ $data->id }}'};
        arrMotor.push(obj);
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

    function submitForm(){
            var form = document.getElementById('formid');
            var msg = "";

            if(document.getElementById("nama").value == ""){
                msg +=("\n* Nama tidak boleh kosong");
            }

            if(document.getElementById("tipe").value == ""){
                msg +=("\n* Tipe tidak boleh kosong");
            }

            if(document.getElementById("stok_min").value == ""){
                msg +=("\n* Stok minimal tidak boleh kosong");
            }

            if(document.getElementById("harga_beli").value == ""){
                msg +=("\n* Harga beli tidak boleh kosong");
            }

            if(document.getElementById("harga_jual").value == ""){
                msg +=("\n* Harga jual tidak boleh kosong");
            }

            if(document.getElementById("motorTable").rows.length == 1){
                msg +=("\n* Motor yang cocok tidak boleh kosong");
            }
            if(msg != ""){
                alert("Peringatan:\n" + msg);
                return false;
            }else{
                form.submit();
            }
            
        }
   </script>
    </div>
    
  </div>
  
@endsection