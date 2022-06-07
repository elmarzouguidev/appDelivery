@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Metric.delivery.__title')

        @include('Sameleon.Admin.Metric.delivery.table')

    </div>
@endsection

@section('javascript')
    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}
@endsection