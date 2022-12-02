@if (auth()->user()->hasAnyRole('Client', 'SuperAdmin', 'Admin'))
    <li>
        <a href="{{ route('admin:home') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
            <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
        </a>
    </li>

    <li class="menu-title" key="t-stock">Stock</li>
    <li>
        <a href="{{ route('admin:products.index') }}">
            @if (auth()->user()->hasAnyRole('SuperAdmin', 'Admin'))
                @if ($new_products)
                    <span class="badge rounded-pill bg-info float-end">{{ $new_products }}</span>
                @endif
            @endif
            <i class="bx bx-store"></i>
            <span key="t-products">{{ __('Produits') }}</span>
        </a>
    </li>
    @if (isAdmin())
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-box"></i>
                @if ($stock_out)
                    <span class="badge rounded-pill bg-danger float-end">{{ $stock_out }}</span>
                @endif
                <span key="t-stock-reg">{{ __('Stock') }}</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('admin:stock.index') }}" key="t-stock-local">{{ __('Local') }}</a></li>
                <li><a href="{{ route('admin:stock.index.delivery') }}" key="t-stock-delivery">{{ __('Livreurs') }}</a>
                </li>
            </ul>
        </li>
    @endif

    @if (isClient())
        <li>
            <a href="{{ route('admin:stock.index') }}" class="waves-effect">

                <i class="bx bxs-box "></i>
                @if ($stock_out)
                    <span class="badge rounded-pill bg-danger float-end">{{ $stock_out }}</span>
                @endif
                <span key="t-stock">{{ __('Stock') }}</span>
            </a>

        </li>
    @endif
@endif

<li class="menu-title" key="t-commands">Commandes</li>

<li>
    <a href="{{ route('admin:commands.index') }}" class="waves-effect">


        <i class="bx bx-cart-alt"></i>
        @if ($total_new_command)
            <span class="badge rounded-pill bg-info float-end">{{ $total_new_command }}</span>
        @endif

        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>
@if (auth()->user()->hasRole('Delivery'))
    <li>
        <a href="{{ route('admin:metrics.delivery') }}" class="waves-effect">


            <i class="bx bx-bar-chart-alt-2"></i>

            <span key="t-metrics">{{ __('Statistiques') }}</span>
        </a>

    </li>
@endif
@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li class="menu-title" key="t-components">{{ __('Clients') }}</li>

    <li>
        <a href="{{ route('admin:clients.index') }}" class="waves-effect">

            <i class="bx bxs-user-detail"></i>
            @if ($new_users)
                <span class="badge rounded-pill bg-info float-end">{{ $new_users }}</span>
            @endif
            <span key="t-clients">{{ __('Clients') }}</span>
        </a>

    </li>
    {{-- <li>
        <a href="{{ route('admin:groups.index') }}" class="waves-effect">

            <i class="bx bx-group"></i>
            
            <span key="t-groups">{{ __('Groups') }}</span>
        </a>

    </li> --}}
@endif

@if (auth()->user()->hasAnyRole('Client', 'SuperAdmin', 'Admin'))
    <li class="menu-title" key="t-docs">Documents</li>

    <li>
        <a href="{{ route('admin:invoices.index') }}">
            <i class="bx bx-file"></i>
            @if ($invoice_non_closed)
                <span class="badge rounded-pill bg-info float-end">{{ $invoice_non_closed }}</span>
            @endif
            <span key="t-invoices">{{ __('Factures') }}</span>
        </a>
    </li>


    @if (isAdmin())
        <li>
            <a href="{{ route('admin:b-livraison.index') }}">
                <i class="bx bx-file"></i>
                @if ($total_bls)
                    <span class="badge rounded-pill bg-info float-end">{{ $total_bls }}</span>
                @endif
                <span key="t-b-livraison">{{ __('Bon de livraison') }}</span>
            </a>
        </li>
    @endif

    <li>
        <a href="{{ route('admin:b-router.index') }}">
            <i class="bx bx-file"></i>
            @if ($total_b_routers)
                <span class="badge rounded-pill bg-warning float-end">{{ $total_b_routers }}</span>
            @endif
            <span key="t-b-router">{{ __('Bon de retour') }}</span>
        </a>
    </li>
    <li class="menu-title" key="t-treausry-s">Trésorerie</li>
    <li>
        <a href="{{ route('admin:payments.index') }}">
            <i class="bx bx-money"></i>
            <span key="t-payments">{{ __('Paiements') }}</span>
        </a>
    </li>
    {{-- @if (isAdmin())
        <li>
            <a href="{{ route('admin:treausry.index') }}">
                <i class="bx bx-money"></i>
                <span class="badge rounded-pill bg-info float-end">new</span>
                <span key="t-treausry">{{ __('Trésorerie') }}</span>
            </a>
        </li>
    @endif --}}

    <li class="menu-title" key="t-reclamations">Réclamations</li>

    <li>
        <a href="{{ route('admin:complaints.index') }}">
            <i class='bx bx-info-circle'></i>
            @if ($total_new_reclamations)
                <span class="badge rounded-pill bg-danger float-end">{{ $total_new_reclamations }}</span>
            @endif
            <span key="t-complaints">{{ __('Réclamations') }}</span>
        </a>
    </li>

    <li class="menu-title" key="t-ramassage">Ramassage</li>

    <li>
        <a href="{{ route('admin:ramassage.index') }}">
            <i class='bx bx-archive-in'></i>
            @if ($ramassage)
                <span class="badge rounded-pill bg-danger float-end">{{ $ramassage }}</span>
            @endif
            <span key="t-ramassage">{{ __('Ramassage') }}</span>
        </a>
    </li>

    <li class="menu-title" key="t-invoices">Contact</li>

    <li>
        <a href="{{ route('admin:contact.index') }}">
            <i class='bx bx-envelope'></i>
            <span key="t-contact">{{ __('Contact') }}</span>
        </a>
    </li>

    {{-- <li>
        <a href="{{ route('admin:apps.index') }}">
            <i class='bx bx-customize'></i>
            <span key="t-contact">{{ __('Apps') }}</span>
        </a>
    </li> --}}

@endif


@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>

    {{-- <li>
        <a href="{{ route('admin:historiques.index') }}" class="waves-effect">
            <span class="badge rounded-pill bg-primary float-end" key="t-new">New</span>
            <i class="bx bx-history"></i>
            <span key="t-historiques">{{ __('Historiques') }}</span>
        </a>

    </li> --}}

    <li>
        <a href="{{ route('admin:annonces.index') }}" class="waves-effect">
            {{-- <span class="badge rounded-pill bg-success float-end" key="t-new">New</span> --}}
            <i class="bx bx-volume-full"></i>
            <span key="t-annonces">{{ __('Annonces') }}</span>
        </a>
    </li>

    <li>
        <a href="{{ route('admin:conditions.index') }}">
            <i class="bx bx-file"></i>
            <span class="badge rounded-pill bg-info float-end">new</span>
            <span key="t-conditions">{{ __('Conditions') }}</span>
        </a>
    </li>
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-line-chart"></i>
            <span key="t-ci-reg">{{ __('Statistiques') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:metrics.delivery') }}" key="t-metrics-delivery">{{ __('Livreurs') }}</a></li>
            <li><a href="{{ route('admin:metrics.cities') }}" key="t-metrics-cities">{{ __('Villes') }}</a></li>
        </ul>
    </li>
    <li>
        <a href="{{ route('admin:delivery.index') }}">
            <i class='bx bxs-truck'></i>
            <span key="t-delivery">{{ __('Livreurs') }}</span>
        </a>
    </li>
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-building-house"></i>
            <span key="t-ci-reg">{{ __('Villes') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:cities.index') }}" key="t-cities">{{ __('Villes') }}</a></li>
            <li><a href="{{ route('admin:regions.index') }}" key="t-regions">{{ __('Régions') }}</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('admin:admins.index') }}" class="waves-effect">

            <i class="bx bx-user-circle"></i>
            <span key="t-authentication">{{ __('Utilisateurs') }}</span>
        </a>

    </li>

    {{-- <li>
        <a href="{{ route('admin:banks.index') }}" class="waves-effect">

            <i class="bx bxs-bank"></i>
            <span key="t-banks">{{ __('Banques') }}</span>
        </a>

    </li> --}}
    {{-- <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-lock"></i>
            <span key="t-authentication">{{ __('Permissions') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:roles.index') }}" key="t-roles">{{ __('Roles') }}</a></li>
            <li><a href="{{ route('admin:permissions.index') }}"
                    key="t-permissions">{{ __('Permissions') }}</a>
            </li>
        </ul>
    </li> --}}
@endif

@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li>

        <a href="{{ route('admin:settings.index') }}" class="waves-effect">
            <i class="bx bx-wrench"></i>
            <span key="t-settings">{{ __('Paramètres') }}</span>
        </a>
        {{-- <ul class="sub-menu" aria-expanded="false">
            <li>
                <a href="{{ route('admin:settings.index') }}" key="t-company">{{ __('Société') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin:settings.invoice') }}" key="t-invoice">{{ __('Facture') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin:integrations.index') }}" key="t-integrations">{{ __('Integrations') }}
                </a>
            </li>
        </ul> --}}
    </li>
@endif
