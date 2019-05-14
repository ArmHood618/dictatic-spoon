@extends('layouts.owner')
@section('content')
<!-- Table - Start -->
<table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 30%;">Item</td>
                <td class="col" style="width: 30%;">Jumlah</td>
                <td class="col" style="width: 30%;">Subtotal</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="width:70%">Total</td>
                <td style="width:30%">{{ $item->total }}</td>
            </tr>
      @else
            <tr>
                <td>Not Found !!!</td>
            </tr>
            @endif
          </tbody>
      </table>
      <!-- Table - End -->
      <!-- Form - Start -->
      {{ Form::open(array('route' => '???', 'method'=>'POST', 'id' => 'formid')) }}
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
        let form = event.target
        var errors = 0

        if(document.getElementById('pembayaran') < {{ $total }}){
            event.preventDefault()
            alert('Peringatan: Biaya kurang')
        } else {

        }
    })
  </script>
@endsection