@extends('layouts.kop')
@section('content')
<h3 class="text-center">SURAT PERINTAH KERJA</h3>
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

<hr>
<h3 class="text-center">SPAREPART</h3>
<hr>
<hr>
<table class="table">
    <thead>
        <th class="col" style="width: 20%;">Kode</th>
        <th class="col" style="width: 20%;">Nama</th>
        <th class="col" style="width: 20%;">Tipe</th>
        <th class="col" style="width: 20%;">Rak</th>
        <th class="col text-right" style="width: 20%;">Jumlah</th>
    </thead>
    <tbody>
        @foreach($sparepart as $s)
        <td>{{ $s->letak->kode }}-{{ $s->ruang->kode }}-{{ $s->id }}</td>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->tipe }}</td>
        <td>{{ $s->letak->letak }}</td>
        <td class="text-right">{{ $s->pivot->jumlah }}</td>
        @endforeach
    </tbody>
</table>
<hr>
<h3 class="text-center">SERVICE</h3>
<hr>
<table class="table">
    <thead>
        <th class="col" style="width: 50%;">Jenis</th>
        <th class="col text-right" style="width: 50%;">Jumlah</th>
    </thead>
    <tbody>
        @foreach($jasa as $j)
        <td>{{ $j->jenis }}</td>
        <td class="text-right">{{ $j->pivot->jumlah }}</td>
        @endforeach
    </tbody>
</table>

@endsection