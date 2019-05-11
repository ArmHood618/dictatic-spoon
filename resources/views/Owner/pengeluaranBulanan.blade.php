@extends('layouts.owner')
@section('content')
<!-- Form - Start -->
{{ Form::open(array('route' => 'owner.pengeluaran_bulanan.create', 'method'=>'POST')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tahun Laporan yang akan dibuat :</strong>
                    {!! Form::text('tanggal',null,array('placeholder' => 'Tahun','class' => 'form-control', 'id' => 'tanggal')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </td>
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
  <script>
  function graph(){
      tahun = document.getElementById('tanggal');
  }
  </script>
@endsection