@extends('layouts.kop')
@section('content')
<h3 class="text-center">LAPORAN PENJUALAN JASA</h3>
<p>Tahun : {{ $tahun }}</p>
<p>Bulan : 
@if($bulan == 1)
Januari
@elseif($bulan == 2)
Februari
@elseif($bulan == 3)
Maret
@elseif($bulan == 4)
April
@elseif($bulan == 5)
Mei
@elseif($bulan == 6)
Juni
@elseif($bulan == 7)
Juli
@elseif($bulan == 8)
Agustus
@elseif($bulan == 9)
September
@elseif($bulan == 10)
Oktober
@elseif($bulan == 11)
November
@else
Desember
@endif
</p>
<br>
<table class="table table-bordered" id="idTable">
    <thead>
        <th>Merek</th>
        <th>Tipe Motor</th>
        <th>Jenis Jasa</th>
        <th>Jumlah Penjualan</th>
    </thead>
    <tbody>
        <?php $cc = 0; ?>
        @foreach($all as $one)
        <tr>
            @if($cc == 0)
            <td rowspan="{{ $cabang_n }}">{{ $one->merek }}</td>
            <td rowspan="{{ $cabang_n }}">{{ $one->tipe }}</td>
            @endif
            <td>{{ $one->jenis }}</td>
            <td>{{ $one->jumlah }}</td>
        </tr>
        <?php $cc = ++$cc % $cabang_n; ?>
        @endforeach
    </tbody>
</table>
@endsection