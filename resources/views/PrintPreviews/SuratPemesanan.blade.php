@extends('layouts.kop')
@section('content')
<h3 class="text-center">SURAT PEMESANAN SPAREPART</h3>
<hr>
<p>Tanggal : {{$data->tanggal}}</p>
<br>
<p>Kepada Yth: <br>
{{$data->supplier->nama}} <br>
{{$data->supplier->alamat}} <br>
{{$data->supplier->kota}} <br>
{{$data->supplier->no_telp}}</p>
<br>
<p>Mohon untuk disediakan barang-barang berikut</p>
<table class="table table-bordered">
    <thead>
        <th class="col" style="width: 20%;">No.</th>
        <th class="col" style="width: 20%;">Nama</th>
        <th class="col" style="width: 20%;">Tipe Barang</th>
        <th class="col text-right" style="width: 20%;">Jumlah</th>
    </thead>
    <tbody>
        <?php $i = 1;?>
        @foreach($data->sparepart as $s)
        <td>{{ $i }}</td>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->tipe }}</td>
        <td>{{ $s->pivot->jumlah }}</td>
        <?php $i++; ?>
        @endforeach
    </tbody>
</table>
@endsection