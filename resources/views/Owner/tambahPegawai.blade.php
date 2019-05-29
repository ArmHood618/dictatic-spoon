@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => 'owner.pegawai.store', 'method'=>'POST', 'id' => 'formid')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nama">Nama Pegawai:</label>
                    {!! Form::text('nama',null,array('placeholder' => 'Nama Pegawai','class' => 'form-control', 'id' => 'nama','required' => 'required')) !!}
                </div> 
                <div class="form-group">
                    <label>Role Pegawai:</label>
                    {!! Form::select('id_role',$role,null,array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label>Cabang Pegawai:</label>
                    {!! Form::select('id_cabang',$cabang,null,array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label>Alamat Pegawai:</label>
                    {!! Form::text('alamat',null,array('placeholder' => 'Alamat Pegawai','class' => 'form-control', 'id' => 'alamat','required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <label>Nomor Telepon Pegawai:</label>
                    {!! Form::number('no_telp',null,array('placeholder' => 'Nomor Telepon Pegawai','class' => 'form-control', 'id' => 'no_telp', 'required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <label>Gaji Pegawai:</label>
                    {!! Form::number('gaji',null,array('placeholder' => 'Gaji Pegawai','class' => 'form-control', 'id' => 'gaji','required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <label>Username Pegawai:</label>
                    {!! Form::text('username',null,array('placeholder' => 'Username Pegawai','class' => 'form-control', 'id' => 'username','required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <label>Password Pegawai:</label>
                    {!! Form::password('password',array('placeholder' => 'Password Pegawai','class' => 'form-control', 'id' => 'password','required' => 'required')) !!}
                </div>
                <div class="form-group">
                    <label>Ulangi Password Pegawai:</label>
                    {!! Form::password('password',array('placeholder' => 'Ulangi Password Pegawai','class' => 'form-control', 'id' => 'password_confirmation','required' => 'required')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.pegawai.index') }}" class="btn btn-danger">Cancel</a>
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
        'use strict'

        document.querySelector('#formid').addEventListener('submit', function (event) {
            let form = event.target
            var errors = 0

            if(document.getElementById('password') != document.getElementById('password_confirmation'))
                errors++

            if (errors > 0) {/
                event.preventDefault()
                alert('Peringatan: Password dan konfirmasi password harus sama')
            }
        })
    </script>
@endsection