<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{-- route('sameleon:home') --}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="60">
                    </span>
                </a>

                <a href="{{-- route('sameleon:home') --}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="60">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Chercher...">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> --}}


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Chercher ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img id="header-lang-img" src="{{ asset('assets/images/flags/french.jpg') }}"
                        alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                        <img src="{{ asset('assets/images/flags/french.jpg') }}" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">French</span>
                    </a>

                </div>
            </div> --}}

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    <span class="badge bg-danger rounded-pill">{{auth()->user()->unreadNotifications->count()}}</span>
                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small" key="t-view-all"> View All</a>
                            </div>
                        </div>
                    </div>
                    @forelse (auth()->user()->unreadNotifications as $notification)
                        <div data-simplebar style="max-height: 230px;">
                            <a href="#" class="text-reset notification-item">
                                <div class="d-flex">
    
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1" key="t-your-order">Nouveau produit créer</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1" key="t-grammer">
                                                <b>{{ $notification->data['client'] }}</b> a crée le produit : <b>{{ $notification->data['name'] }}</b>
                                            </p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                    key="t-min-ago">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                            </p>
                                            
                                        </div>
                      
                                    </div>

                                </div>
                            </a>
                        </div>

                    @empty

                        <div class="p-2 border-top d-grid">
                            aucune notification pour le moment
                        </div>
                    @endforelse
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    @if (auth()->user()->logo)
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('storage/' . auth()->user()->logo) }}" alt="Sameleon">
                    @else
                        <img class="rounded-circle header-profile-user" src="{{ asset('images/logo.png') }}"
                            alt="Sameleon">
                    @endif


                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">
                        {{ auth()->user()->full_name ?? '' }}
                    </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a class="dropdown-item d-block" href="{{ route('admin:profil') }}">

                        <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profil</span>
                    </a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item d-block" href="{{ route('admin:api.index') }}">

                        <i class="bx bx-stats font-size-16 align-middle me-1"></i>
                        <span key="t-profile">API & integration</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item d-block" href="{{ route('admin:profile.sources.index') }}">

                        <i class="bx bx-stats font-size-16 align-middle me-1"></i>
                        <span key="t-sources">Source de données</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item d-block" href="{{ route('admin:history') }}">

                        <i class="bx bx-history font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Historique</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#"
                        onclick="document.getElementById('logoutForm').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        <span key="t-logout">Se déconnecter</span>
                    </a>

                    <form id="logoutForm" method="post" action="{{ route('admin:auth:logout') }}">
                        @csrf

                    </form>

                </div>
            </div>

            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="bx bx-cog bx-spin"></i>
                </button>
            </div> --}}

        </div>
    </div>
</header>
