@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Metric.Delivery.__title')

        @include('Sameleon.Admin.Metric.Delivery.table')

    </div>
@endsection

@section('javascript')
    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}
@endsection