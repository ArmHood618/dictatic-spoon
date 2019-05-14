@extends('layouts.kop')
@section('content')
<h3 class="text-center">LAPORAN PENGELUARAN BULANAN</h3>
<p>Tahun : {{ $tahun }}</p>
<br>
<table class="table table-bordered" id="idTable">
    <thead>
        <th>No.</th>
        <th>Bulan</th>
        <th>Nama Barang</th>
        <th>Tipe Barang</th>
        <th>Jumlah Penjualan</th>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td>Januari</td>
            <td>@if(isset($all[0])){{ $all[0]->nama }}@else  @endif</td>
            <td>@if(isset($all[0])){{ $all[0]->tipe }}@else  @endif</td>
            <td>@if(isset($all[0])){{ $all[0]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Februari</td>
            <td>@if(isset($all[1])){{ $all[1]->nama }}@else  @endif</td>
            <td>@if(isset($all[1])){{ $all[1]->tipe }}@else  @endif</td>
            <td>@if(isset($all[1])){{ $all[1]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Maret</td>
            <td>@if(isset($all[2])){{ $all[2]->nama }}@else  @endif</td>
            <td>@if(isset($all[2])){{ $all[2]->tipe }}@else  @endif</td>
            <td>@if(isset($all[2])){{ $all[2]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>April</td>
            <td>@if(isset($all[3])){{ $all[3]->nama }}@else  @endif</td>
            <td>@if(isset($all[3])){{ $all[3]->tipe }}@else  @endif</td>
            <td>@if(isset($all[3])){{ $all[3]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Mei</td>
            <td>@if(isset($all[4])){{ $all[4]->nama }}@else  @endif</td>
            <td>@if(isset($all[4])){{ $all[4]->tipe }}@else  @endif</td>
            <td>@if(isset($all[4])){{ $all[4]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Juni</td>
            <td>@if(isset($all[5])){{ $all[5]->nama }}@else  @endif</td>
            <td>@if(isset($all[5])){{ $all[5]->tipe }}@else  @endif</td>
            <td>@if(isset($all[5])){{ $all[5]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Juli</td>
            <td>@if(isset($all[6])){{ $all[6]->nama }}@else  @endif</td>
            <td>@if(isset($all[6])){{ $all[6]->tipe }}@else  @endif</td>
            <td>@if(isset($all[6])){{ $all[6]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Agustus</td>
            <td>@if(isset($all[7])){{ $all[7]->nama }}@else  @endif</td>
            <td>@if(isset($all[7])){{ $all[7]->tipe }}@else  @endif</td>
            <td>@if(isset($all[7])){{ $all[7]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>9.</td>
            <td>September</td>
            <td>@if(isset($all[8])){{ $all[8]->nama }}@else  @endif</td>
            <td>@if(isset($all[8])){{ $all[8]->tipe }}@else  @endif</td>
            <td>@if(isset($all[8])){{ $all[8]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Oktober</td>
            <td>@if(isset($all[9])){{ $all[9]->nama }}@else  @endif</td>
            <td>@if(isset($all[9])){{ $all[9]->tipe }}@else  @endif</td>
            <td>@if(isset($all[9])){{ $all[9]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>11.</td>
            <td>November</td>
            <td>@if(isset($all[10])){{ $all[10]->nama }}@else  @endif</td>
            <td>@if(isset($all[10])){{ $all[10]->tipe }}@else  @endif</td>
            <td>@if(isset($all[10])){{ $all[10]->jumlah}}@else 0 @endif</td>
        </tr>
        <tr>
            <td>12.</td>
            <td>Desember</td>
            <td>@if(isset($all[11])){{ $all[11]->nama }}@else  @endif</td>
            <td>@if(isset($all[11])){{ $all[11]->tipe }}@else  @endif</td>
            <td>@if(isset($all[11])){{ $all[11]->jumlah}}@else 0 @endif</td>
        </tr>
    </tbody>
</table>
<script>

</script>
@endsection