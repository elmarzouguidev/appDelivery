@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Home2.section.__title')

        @include('Sameleon.Admin.Home2.section.section_a')

   

        @include('Sameleon.Admin.Home2.section.section_c')

    </div>
@endsection

@section('javascript')
    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}

    {!! $chart2->renderChartJsLibrary() !!}
    {!! $chart2->renderJs() !!}

@endsection