@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.supplier.update',$data->id], 'method'=>'PATCH')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Supplier :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama','class' => 'form-control','required' => 'required')) !!}
                    <strong>Alamat :</strong>
                    {!! Form::text('alamat',$data->alamat,array( 'placeholder' => 'Alamat','class' => 'form-control','required' => 'required')) !!}
                    <strong>Kota :</strong>
                    {!! Form::text('kota',$data->kota,array('placeholder' => 'Kota','class' => 'form-control', 'id' => 'alamat','required' => 'required')) !!}
                    <strong>Nomor Telepon :</strong>
                    {!! Form::number('no_telp',$data->no_telp,array( 'placeholder' => 'Nomor Telepon','class' => 'form-control','required' => 'required')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.supplier.index') }}" class="btn btn-danger">Cancel</a>
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