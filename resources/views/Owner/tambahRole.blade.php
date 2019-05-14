@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => 'owner.role.store', 'method'=>'POST', 'id' => 'formid')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Role (2 huruf kapital):</strong>
                    {!! Form::text('id',null,array('placeholder' => 'ID','class' => 'form-control','maxlength' => '2', 'onkeydown' => 'upperCase(this)')) !!}
                    <strong>Keterangan Role :</strong>
                    {!! Form::text('keterangan',null,array('placeholder' => 'Keterangan','class' => 'form-control', 'id' => 'keterangan', 'required' => 'required')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.role.index') }}" class="btn btn-danger">Cancel</a>
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

            if(document.getElementById("keterangan").value == ""){
                msg +=("\n* Keterangan tidak boleh kosong");
            }
            if(msg != ""){
                alert("Peringatan:\n" + msg);
                return false;
            }else{
                form.submit();
            }
            
        }

        function upperCase(a){
            setTimeout(function(){
                a.value = a.value.toUpperCase();
            },1);
        }
  </script>
@endsection