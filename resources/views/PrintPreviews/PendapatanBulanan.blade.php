@extends('layouts.kop')
@section('content')
<h3 class="text-center">LAPORAN PENDAPATAN BULANAN</h3>
<p>Tahun : {{ $tahun }}</p>
<br>
<table class="table table-bordered" id="idTable">
    <thead>
        <th>No.</th>
        <th>Bulan</th>
        <th>Service</th>
        <th>Sparepart</th>
        <th>Total</th>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td>Januari</td>
            <td>@if(isset($all[0])){{ $all[0]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[0])){{ $all[0]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[0])){{ $all[0]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Februari</td>
            <td>@if(isset($all[1])){{ $all[1]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[1])){{ $all[1]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[1])){{ $all[1]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Maret</td>
            <td>@if(isset($all[2])){{ $all[2]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[2])){{ $all[2]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[2])){{ $all[2]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>April</td>
            <td>@if(isset($all[3])){{ $all[3]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[3])){{ $all[3]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[3])){{ $all[3]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Mei</td>
            <td>@if(isset($all[4])){{ $all[4]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[4])){{ $all[4]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[4])){{ $all[4]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Juni</td>
            <td>@if(isset($all[5])){{ $all[5]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[5])){{ $all[5]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[5])){{ $all[5]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Juli</td>
            <td>@if(isset($all[6])){{ $all[6]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[6])){{ $all[6]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[6])){{ $all[6]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Agustus</td>
            <td>@if(isset($all[7])){{ $all[7]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[7])){{ $all[7]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[7])){{ $all[7]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>9.</td>
            <td>September</td>
            <td>@if(isset($all[8])){{ $all[8]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[8])){{ $all[8]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[8])){{ $all[8]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>10.</td>
            <td>Oktober</td>
            <td>@if(isset($all[9])){{ $all[9]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[9])){{ $all[9]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[9])){{ $all[9]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>11.</td>
            <td>November</td>
            <td>@if(isset($all[10])){{ $all[10]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[10])){{ $all[10]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[10])){{ $all[10]->total }}@else 0 @endif</td>
        </tr>
        <tr>
            <td>12.</td>
            <td>Desember</td>
            <td>@if(isset($all[11])){{ $all[11]->subtotal_jasa }}@else 0 @endif</td>
            <td>@if(isset($all[11])){{ $all[11]->subtotal_sparepart }}@else 0 @endif</td>
            <td>@if(isset($all[11])){{ $all[11]->total }}@else 0 @endif</td>
        </tr>
    </tbody>
</table>
<script>

</script>
@endsection