<!DOCTYPE html>

<html lang="fr">

@include('layouts._section.head_mix')

<body data-topbar="dark" data-sidebar-size="small-">


    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div id="layout-wrapper">

        @include('layouts._parts.__header')

        @include('layouts._parts._leftSidebar_commercial')

        <div class="main-content">

            <div class="page-content">

                @if (!auth()->user()->completProfile())
                    @include('layouts._parts.__warning')
                @endif

                @if (auth()->user()->isActive())
                    @yield('content')
                @else
                    @include('layouts._parts.__disabled_account')
                @endif


            </div>

            {{-- @include('theme.layouts._parts._subscribe') --}}

            @include('layouts._parts._footer')

        </div>

    </div>


    {{--@include('layouts._parts._rightSidebar')--}}


    @include('layouts._parts._overly')

    @livewireScripts

    <script src="{{ asset('js/app.js') }}" data-pagespeed-no-defer></script>

    {{--@include('layouts._parts.__global_js')--}}

    @stack('scripts')

    @yield('javascript')

    <script>
        $('a[href="#"]').click(function(event) {

            event.preventDefault();

        });

        window.addEventListener('reloadbrowser', event => {

            setTimeout(function() {
                window.location.reload();
            }, 1000);

        });
    </script>


</body>

</html>
