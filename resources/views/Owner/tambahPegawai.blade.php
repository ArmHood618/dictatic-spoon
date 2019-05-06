@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => 'owner.pegawai.store', 'method'=>'POST')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Pegawai :</strong>
                    {!! Form::text('nama',null,array('placeholder' => 'Nama Pegawai','class' => 'form-control')) !!}
                    <strong>Role Pegawai :</strong>
                    {!! Form::select('id_role',$role,null,array('class' => 'form-control')) !!}
                    <strong>Cabang Pegawai :</strong>
                    {!! Form::select('id_cabang',$cabang,null,array('class' => 'form-control')) !!}
                    <strong>Alamat Pegawai :</strong>
                    {!! Form::text('alamat',null,array('placeholder' => 'Alamat Pegawai','class' => 'form-control')) !!}
                    <strong>Nomor Telepon Pegawai :</strong>
                    {!! Form::number('no_telp',null,array('placeholder' => 'Nomor Telepon Pegawai','class' => 'form-control')) !!}
                    <strong>Gaji Pegawai :</strong>
                    {!! Form::number('gaji',null,array('placeholder' => 'Gaji Pegawai','class' => 'form-control')) !!}
                    <strong>Username Pegawai :</strong>
                    {!! Form::text('username',null,array('placeholder' => 'Username Pegawai','class' => 'form-control')) !!}
                    <strong>Password Pegawai :</strong>
                    {!! Form::password('password',array('placeholder' => 'Password Pegawai','class' => 'form-control')) !!}
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
  
@endsection