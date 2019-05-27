@extends('layouts.owner')
@section('content')
<!-- Form - Start -->
{{ Form::open(array('route' => 'owner.penjualan_jasa.create', 'method'=>'POST')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tahun Laporan yang akan dibuat :</strong>
                    {!! Form::number('tahun',null,array('placeholder' => 'Tahun','class' => 'form-control','required' => 'required', 'maxlength' => '4')) !!}
                    <strong>Bulan Laporan yang akan dibuat(angka) :</strong>
                    {!! Form::number('bulan',null,array('placeholder' => 'Bulan','class' => 'form-control','required' => 'required', 'maxlength' => '2')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
      {{ Form::close() }}
      <!-- Form - End -->
    </div>
    
  </div>
@endsection