@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.pegawai.update',$data->id], 'method'=>'PATCH')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Pegawai :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama Pegawai','class' => 'form-control','required' => 'required')) !!}
                    <strong>Role Pegawai :</strong>
                    {!! Form::select('id_role',$role,$data->id_role,array('class' => 'form-control')) !!}
                    <strong>Cabang Pegawai :</strong>
                    {!! Form::select('id_cabang',$cabang,$data->id_cabang,array('class' => 'form-control')) !!}
                    <strong>Alamat Pegawai :</strong>
                    {!! Form::text('alamat',$data->alamat,array('placeholder' => 'Alamat Pegawai','class' => 'form-control','required' => 'required')) !!}
                    <strong>Nomor Telepon Pegawai :</strong>
                    {!! Form::text('no_telp',$data->no_telp,array('placeholder' => 'Nomor Telepon Pegawai','class' => 'form-control','required' => 'required')) !!}
                    <strong>Gaji Pegawai :</strong>
                    {!! Form::text('gaji',$data->gaji,array('placeholder' => 'Gaji Pegawai','class' => 'form-control','required' => 'required')) !!}
                    <strong>Username Pegawai :</strong>
                    {!! Form::text('username',$data->username,array('placeholder' => 'Username Pegawai','class' => 'form-control','required' => 'required')) !!}
                    <strong>Password Pegawai :</strong>
                    {!! Form::password('password',array('placeholder' => 'Password Pegawai','class' => 'form-control','required' => 'required')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      {{ Form::close() }}
      <!-- Form - End -->
      
    </div>
    
  </div>
  
@endsection