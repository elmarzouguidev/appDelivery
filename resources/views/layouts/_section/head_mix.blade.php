<head>

    <meta charset="utf-8" />
    <title>SAMELEON EXPRESS System</title>

    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="app_version" name="1.0.0" />
    <meta content="app_devlopper" name="Elmarzougui Abdelghafour" />
    <meta content="app_devlopper_website" name="elmarzougui.net" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="SameleonExpress" />
    <meta property="og:description" content="SameleonExpress société de livraison au Maroc" />
    <meta property="og:site_name" content="SameleonExpress" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:url" content="https://app.sameleon-express.ma/" />
    <meta property="og:image" content="https://app.sameleon-express.ma/images/logo.png" />

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

    @yield('css')
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/mix/app.css') }}?ver={{ rand(1, 852) }}" rel="stylesheet" type="text/css" />

    @livewireStyles

</head>