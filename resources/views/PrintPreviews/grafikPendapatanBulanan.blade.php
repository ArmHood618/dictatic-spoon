@extends('layouts.kop')
@section('content')
<div style="width:75%;">
    {!! $chart->container() !!}
</div>
{!! $chart->script() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"></script>
@endsection