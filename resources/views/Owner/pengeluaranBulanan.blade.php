@extends('layouts.owner')
@section('content')
<!-- Form - Start -->
{{ Form::open(array('route' => 'owner.pengeluaran_bulanan.create', 'method'=>'POST')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tahun Laporan yang akan dibuat :</strong>
                    {!! Form::number('tahun',null,array('placeholder' => 'Tahun','class' => 'form-control', 'id' => 'tanggal','required' => 'required', 'id' => 'tahun')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="button" onclick="graph()" class="btn btn-primary">Graph</button>
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
    tahun = document.getElementById('tahun').value;
    url = '{{ URL::to('owner/pengeluaran_bulanan/chart/') }}';
    var printWindow = window.open(url.concat('/'.concat(tahun)));
    printWindow.addEventListener('load', function(){
        setTimeout(function(){
            printWindow.print();
            printWindow.close();
        },300);
    }, true);
  }
  </script>
@endsection