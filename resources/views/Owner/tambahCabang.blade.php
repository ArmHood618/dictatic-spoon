@extends('layouts.owner')
@section('content')
      <!-- Form - Start -->
      {{ Form::open(array('route' => 'owner.cabang.store', 'method'=>'POST')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Daerah :</strong>
                    {!! Form::text('daerah',null,array('placeholder' => 'Daerah','class' => 'form-control')) !!}
                    <strong>Alamat :</strong>
                    {!! Form::text('alamat',null,array('placeholder' => 'Alamat','class' => 'form-control')) !!}
                    <strong>Kota :</strong>
                    {!! Form::text('kota',null,array('placeholder' => 'Kota','class' => 'form-control')) !!}
                    <strong>Kode Pos :</strong>
                    {!! Form::number('kode_pos',null,array('placeholder' => 'Kode Pos','class' => 'form-control')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.cabang.index') }}" class="btn btn-danger">Cancel</a>
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