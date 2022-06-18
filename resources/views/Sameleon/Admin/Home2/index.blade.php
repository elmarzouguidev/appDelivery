@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Home2.section.__title')

        @include('Sameleon.Admin.Home2.section.section_a')

        @include('Sameleon.Admin.Home2.section.section_c')

    </div>
    @php

    $viewed = $annonces->viewed ?? [];

    @endphp

    @if (auth()->id() && !in_array(auth()->id(), $viewed))

        @include('Sameleon.Admin.Home2.section.__annonces')
        
    @endif

@endsection

@section('javascript')
    <script>
        setTimeout(function() {
            $("#annoncesModal").modal("show");
        }, 2e3);
    </script>

    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}

    {!! $chart2->renderChartJsLibrary() !!}
    {!! $chart2->renderJs() !!}

    @include('Sameleon.Admin.Home2.__js')
@endsection
