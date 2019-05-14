@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.role.update',$data->id], 'method'=>'PATCH')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Role (2 huruf kapital):</strong>
                    {!! Form::text('id',$data->id,array('placeholder' => 'ID','class' => 'form-control', 'readonly')) !!}
                    <strong>Keterangan Role :</strong>
                    {!! Form::text('keterangan',$data->keterangan,array('placeholder' => 'Keterangan','class' => 'form-control','required' => 'required')) !!}
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