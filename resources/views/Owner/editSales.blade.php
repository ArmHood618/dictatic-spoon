@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.sales.update', $data->id], 'method'=>'PATCH')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Sales :</strong>
                    {!! Form::text('nama',$data->nama,array('placeholder' => 'Nama','class' => 'form-control')) !!}
                    <strong>Supplier :</strong>
                    {!! Form::select('id_supplier',$supplier,$data->id_supplier,array('class' => 'form-control')) !!}
                    <strong>Nomor Telepon :</strong>
                    {!! Form::number('no_telp',$data->no_telp,array('placeholder' => 'Nomor Telepon','class' => 'form-control')) !!}
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