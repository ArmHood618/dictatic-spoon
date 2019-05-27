@extends('layouts.kop')
@section('content')
<h3 class="text-center">NOTA LUNAS</h3>
<hr>
<div class="d-flex">
    <div class="flex-column mr-auto">
        <p class="text-body"></p>
        <p class="text-body">Cust    :{{ $data->nama }}</p>
        <p class="text-body">Telp    :{{ $data->no_telp }}</p>
        <p class="text-body">Motor   :{{ $data->motor->tipe }}</p>
    </div>
    <div class="flex-column mr-auto">
        <p class="text-body"></p>
        <p class="text-body">CS       :{{ $pegawai->nama }}</p>
        <p class="text-body">Montir   :{{ $montir->nama }}</p>
    </div>
</div>
<?php $total = 0; ?>
@if(!$sparepart->isEmpty())
<hr>
<h3 class="text-center">SPAREPART</h3>
<hr>
<hr>
<table class="table table-bordered">
    <thead>
        <th class="col" style="width: 20%;">Kode</th>
        <th class="col" style="width: 20%;">Nama</th>
        <th class="col" style="width: 20%;">Tipe</th>
        <th class="col" style="width: 20%;">Harga</th>
        <th class="col text-right" style="width: 20%;">Jumlah</th>
        <th class="col text-right" style="width: 20%;">Subtotal</th>
    </thead>
    <tbody>
        @foreach($sparepart as $s)
        <td>{{ $s->letak->kode }}-{{ $s->ruang->kode }}-{{ $s->id }}</td>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->tipe }}</td>
        <td>{{ $s->letak->letak }}</td>
        <td class="text-right">{{ $s->pivot->jumlah }}</td>
        <td class="text-right">{{ $s->pivot->jumlah * $s->harga_jual }}</td>
        <?php $total += $s->pivot->jumlah * $s->harga_jual; ?>
        @endforeach
        <!--<td class="text-right"> $sparepart->total </td>-->
    </tbody>
</table>
@endif
@if(!$jasa->isEmpty())
<hr>
<h3 class="text-center">SERVICE</h3>
<hr>
<table class="table">
    <thead>
        <th class="col" style="width: 25%;">Jenis</th>
        <th class="col" style="width: 25%;">Harga</th>
        <th class="col text-right" style="width: 25%;">Jumlah</th>
        <th class="col text-right" style="width: 25%;">Subtotal</th>
    </thead>
    <tbody>
        @foreach($jasa as $j)
        <tr>
            <td>{{ $j->jenis }}</td>
            <td>{{ $j->harga }}</td>
            <td class="text-right">{{ $j->pivot->jumlah }}</td>
            <td class="text-right">{{ $j->pivot->jumlah * $j->harga }}</td>
        </tr>
        <?php $total += $j->pivot->jumlah * $j->harga; ?>
        @endforeach
    </tbody>
</table>
@endif
<table>
    <tr>
        <td cellpadding="10">Customer</td>
        <td cellpadding="10">Kasir</td>
    </tr>
    <tr>
        <td cellpadding="10">{{ $data->nama }}</td>
        <td cellpadding="10">{{ session()->get('nama') }}</td>
    </tr>
</table>
<h5 class="text-right">Total : Rp.{{ $total }}</h5>
@endsection