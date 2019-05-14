@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.motor.update',$data->id], 'method'=>'PATCH')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Merek :</strong>
                    {!! Form::select('id_merek',$merek,$data->id_merek,array('class' => 'form-control')) !!}
                    <strong>Tipe :</strong>
                    {!! Form::text('tipe',$data->tipe,array('placeholder' => 'Tipe','class' => 'form-control','required' => 'required')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.motor.index') }}" class="btn btn-danger">Cancel</a>
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