@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.SubDelivery.Home2.section.__title')

        @include('Sameleon.Admin.SubDelivery.Home2.section.section_a')

        @include('Sameleon.Admin.SubDelivery.Home2.section.section_c')

    </div>
    @if($annonces->count())  
        @php

        $viewedIds = $annonces->viewed ?? [];

        @endphp

        @if (delivery()->id && !in_array(delivery()->id , $viewedIds))

            @include('Sameleon.Admin.SubDelivery.Home2.section.__annonces')
            
        @endif
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

    @include('Sameleon.Admin.SubDelivery.Home2.__js')
@endsection
