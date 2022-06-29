@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Metric.city.__title')

        @include('Sameleon.Admin.Metric.city.table')

    </div>
@endsection

@section('javascript')

@endsection