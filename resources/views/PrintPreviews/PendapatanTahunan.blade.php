@extends('layouts.kop')
@section('content')
<h3 class="text-center">LAPORAN PENDAPATAN TAHUNAN</h3>
<br>
<table class="table table-bordered" id="idTable">
    <thead>
        <th>Tahun</th>
        <th>Cabang</th>
        <th>Subtotal</th>
    </thead>
    <tbody>
        <?php $cc = 0; ?>
        @foreach($all as $one)
        <tr>
            @if($cc == 0)
            <td rowspan="{{ $cabang_n }}">{{ $one->tahun }}</td>
            @endif
            <td>{{ $one->daerah }}</td>
            <td>{{ $one->total }}</td>
        </tr>
        <?php $cc = ++$cc % $cabang_n; ?>
        @endforeach
    </tbody>
</table>
@endsection