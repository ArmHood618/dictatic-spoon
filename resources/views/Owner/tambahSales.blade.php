@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => 'owner.sales.store', 'method'=>'POST', 'id' => 'formid')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Sales :</strong>
                    {!! Form::text('nama',null,array('placeholder' => 'Nama','class' => 'form-control', 'id' => 'nama')) !!}
                    <strong>Supplier :</strong>
                    {!! Form::select('id_supplier',$supplier,null,array('class' => 'form-control')) !!}
                    <strong>Nomor Telepon :</strong>
                    {!! Form::number('no_telp',null,array('placeholder' => 'Nomor Telepon','class' => 'form-control','id'=>'no_telp')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.sales.index') }}" class="btn btn-danger">Cancel</a>
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
    </div>
    
  </div>
  <script>
        function submitForm(){
            var form = document.getElementById('formid');
            var msg = "";

            if(document.getElementById("nama").value == ""){
                msg +=("\n* Nama tidak boleh kosong");
            }

            if(document.getElementById("no_telp").value == ""){
                msg +=("\n* Nomor telepon tidak boleh kosong");
            }
            if(msg != ""){
                alert("Peringatan:\n" + msg);
                return false;
            }else{
                form.submit();
            }
            
        }
  </script>
@endsection