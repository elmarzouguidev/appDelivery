<head>

    <meta charset="utf-8" />
    <title>SAMELEON EXPRESS System</title>

    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="app_version" name="1.0.0" />
    <meta content="app_devlopper" name="Elmarzougui Abdelghafour" />
    <meta content="app_devlopper_website" name="elmarzougui.net" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    @include('layouts._parts.__og_meta')

    @yield('css')
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/mix/app.css') }}?ver={{ rand(1, 852) }}" rel="stylesheet" type="text/css" />

    @livewireStyles

</head>