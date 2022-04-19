<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="utf-8" />
    <title>SAMELEON EXPRESS Application</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="app_version" name="v 1.1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    @yield('css')

    <link href="{{ asset('css/app.css') }}?ver={{rand(1,500)}}" rel="stylesheet" type="text/css" />

    @livewireStyles

</head>

<body data-topbar="dark" data-sidebar-size="small-">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div id="layout-wrapper">

        @include('layouts._parts.__header')

        @include('layouts._parts._leftSidebar_commercial')

        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>

            {{-- @include('theme.layouts._parts._subscribe') --}}

            @include('layouts._parts._footer')

        </div>

    </div>


    {{-- @include('theme.layouts._parts._rightSidebar') --}}


    @include('layouts._parts._overly')

    @livewireScripts

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <script>
        $('a[href="#"]').click(function(event) {

            event.preventDefault();

        });
    </script>


</body>

</html>
