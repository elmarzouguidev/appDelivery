@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Home2.section.__title')

        @include('Sameleon.Admin.Home2.section.section_a')

        @include('Sameleon.Admin.Home2.section.section_c')

    </div>
    @if($annonces->count())  
        @php

        $viewedIds = $annonces->viewed ?? [];

        @endphp

        @if (auth()->id() && !in_array(auth()->id(), $viewedIds))

            @include('Sameleon.Admin.Home2.section.__annonces')
            
        @endif
    @endif

    @if(isClient() && auth()->user()->unreadNotifications->count())

           @include('Sameleon.Admin.Home2.section.__notifications')

    @endif

@endsection

@section('javascript')
    <script>
        setTimeout(function() {
            $("#annoncesModal").modal("show");
        }, 2e3);
    </script>

    <script>
        setTimeout(function() {
            $("#notificationsModal").modal("show");
        }, 2e3);
    </script>

    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}

    {!! $chart2->renderChartJsLibrary() !!}
    {!! $chart2->renderJs() !!}

    @include('Sameleon.Admin.Home2.__js')
@endsection
