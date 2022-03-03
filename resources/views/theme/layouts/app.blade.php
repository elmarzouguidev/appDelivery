<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="utf-8" />
    <title>SAMELEON EXPRESS </title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="app_creator" name="Elmarzougui Abdelghafour" />
    <meta content="app_version" name="v 1.1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    @yield('css')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    @livewireStyles

</head>
 
<body data-sidebar="dark" data-sidebar-size="small-">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div id="layout-wrapper" >

        @include('theme.layouts._parts.__header')

        @include('theme.layouts._parts._leftSidebar_commercial')

        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>

            {{-- @include('theme.layouts._parts._subscribe') --}}

            @include('theme.layouts._parts._footer')

        </div>

    </div>


    {{-- @include('theme.layouts._parts._rightSidebar') --}}


    @include('theme.layouts._parts._overly')

    @livewireScripts

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')


</body>

</html>
