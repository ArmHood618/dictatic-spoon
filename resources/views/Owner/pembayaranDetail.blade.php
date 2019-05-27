@extends('layouts.owner')
@section('content')
<!-- Table - Start -->
    <h4>Sparepart</h4>
    <table class="table table-bordered" style="width: 100%;">
      @if(count($sparepart))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 30%;">Item</td>
                <td class="col" style="width: 30%;">Jumlah</td>
                <td class="col" style="width: 30%;">Subtotal</td>
            </tr>
          </thead>
          <tbody>
            @foreach($sparepart as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
            @endforeach
      @else
            <tr>
                <td>Tidak Ada !!!</td>
            </tr>
      @endif
          </tbody>
      </table>
      <!-- Table - End -->
      <h4>Jasa</h4>
    <table class="table table-bordered" style="width: 100%;">
      @if(count($jasa))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 30%;">Item</td>
                <td class="col" style="width: 30%;">Subtotal</td>
            </tr>
          </thead>
          <tbody>
            @foreach($jasa as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
            @endforeach
      @else
            <tr>
                <td>Tidak Ada !!!</td>
            </tr>
      @endif
          </tbody>
      </table>
      <!-- Table - End -->
      <h4 class="text-right">Total : {{ $total }}</h4>
      <!-- Form - Start -->
      {{ Form::open(array('route' => ['owner.transaksi.lunas',$id], 'method'=>'POST', 'id' => 'formid')) }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pembayaran:</strong>
                    {!! Form::number('pembayaran',null,array('placeholder' => 'Pembayaran','class' => 'form-control', 'id' => 'pembayaran')) !!}
                </div>
            </div>

            <table class="ml-auto">
                <tr>
                    <td>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('owner.role.index') }}" class="btn btn-danger">Cancel</a>
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
  <script>
    'use strict'

    document.querySelector('#formid').addEventListener('submit', function (event) {
        let form = event.target;
        var errors = 0;
        var total = {{ $total }};
        if(document.getElementById('pembayaran').value < total){
            event.preventDefault();
            alert('Peringatan: Biaya kurang');
        }else if(document.getElementById('pembayaran').value > total){
            var kembali = document.getElementById('pembayaran').value - total;
            alert('Kembalian : Rp. '+kembali);
        }
    })
  </script>
@endsection