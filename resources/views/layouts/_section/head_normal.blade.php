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

    
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/normal/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/normal/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/normal/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    @yield('css')
    
    @livewireStyles
</head>
