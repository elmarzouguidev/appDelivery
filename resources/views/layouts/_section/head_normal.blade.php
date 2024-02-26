<head>

    <meta charset="utf-8" />
    <title>SameleonExpress System</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Elmarzougui Abdelghafour">
    <meta name="app_version" content="1.0.0" />
    <meta name="app_devlopper" content="Elmarzougui Abdelghafour" />
    <meta name="app_devlopper_website" content="https://elmarzougui.com" />
    <meta name="app_devlopper_facebook" content="https://www.facebook.com/devscript" />
    <meta name="app_devlopper_linkedin" content="https://www.linkedin.com/in/devscript/" />
    <meta name="app_devlopper_twitter"  content="https://twitter.com/devscriptt" />
    <meta name="app_devlopper_github"   content="https://github.com/elmarzouguidev" />

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
