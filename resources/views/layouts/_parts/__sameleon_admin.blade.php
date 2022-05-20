@if(auth()->user()->hasAnyRole('Client','SuperAdmin','Admin'))
<li>
    <a href="{{ route('admin:home') }}" class="waves-effect">
        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
    </a>
</li>

<li class="menu-title" key="t-stock">Stock</li>
<li>
    <a href="{{ route('admin:products.index') }}">
        <i class="bx bx-store"></i>
        <span key="t-products">{{ __('Produits') }}</span>
    </a>
</li>
<li>
    <a href="{{ route('admin:stock.index') }}" class="waves-effect">

        <i class="bx bxs-box "></i>
        @if($stock_out)
            <span class="badge rounded-pill bg-danger float-end">{{$stock_out}}</span>
        @endif
        <span key="t-stock">{{ __('Stock') }}</span>
    </a>

</li>
@endif
<li class="menu-title" key="t-commands">Commandes</li>

<li>
    <a href="{{ route('admin:commands.index') }}" class="waves-effect">

        
        <i class="bx bx-cart-alt"></i>
        @if($total_new_command)
         <span class="badge rounded-pill bg-info float-end">{{$total_new_command}}</span>
        @endif
        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>
@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li class="menu-title" key="t-components">{{ __('Clients') }}</li>

    <li>
        <a href="{{ route('admin:clients.index') }}" class="waves-effect">

            <i class="bx bxs-user-detail"></i>
            
            <span key="t-clients">{{ __('Clients') }}</span>
        </a>

    </li>
@endif    

@if(auth()->user()->hasAnyRole('Client','SuperAdmin','Admin'))
<li class="menu-title" key="t-invoices">Factures</li>

<li>
    <a href="{{ route('admin:invoices.index') }}">
        <i class="bx bx-file"></i>
        @if($invoice_non_closed)
          <span class="badge rounded-pill bg-info float-end">{{$invoice_non_closed}}</span>
        @endif
        <span key="t-invoices">{{ __('Factures') }}</span>
    </a>
</li>
<li>
    <a href="{{ route('admin:payments.index') }}">
        <i class="bx bx-money"></i>
        <span key="t-payments">{{ __('Paiements') }}</span>
    </a>
</li>

<li class="menu-title" key="t-invoices">Réclamations</li>

<li>
    <a href="{{ route('admin:complaints.index') }}">
        <i class='bx bx-info-circle'></i>
        @if($total_new_reclamations)
         <span class="badge rounded-pill bg-danger float-end">{{$total_new_reclamations}}</span>
        @endif
        <span key="t-complaints">{{ __('Réclamations') }}</span>
    </a>
</li>

<li class="menu-title" key="t-ramassage">Ramassage</li>

<li>
    <a href="{{ route('admin:ramassage.index') }}">
        <i class='bx bx-archive-in'></i>
        {{--@if($total_new_reclamations)
         <span class="badge rounded-pill bg-danger float-end">{{$total_new_reclamations}}</span>
        @endif--}}
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

@endif  

@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bxs-truck"></i>
            <span key="t-ci-reg">{{ __('Livreurs') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:delivery.index') }}" key="t-delivery">{{ __('Livreurs') }}</a></li>
        </ul>
    </li>
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-building-house"></i>
            <span key="t-ci-reg">{{ __('Villes') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:cities.index') }}" key="t-cities">{{ __('Villes') }}</a></li>
            <li><a href="{{ route('admin:regions.index') }}"
                    key="t-regions">{{ __('Régions') }}</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('admin:admins.index') }}" class="waves-effect">

            <i class="bx bx-user-circle"></i>
            <span key="t-authentication">{{ __('Utilisateurs') }}</span>
        </a>

    </li>
    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-lock"></i>
            <span key="t-authentication">{{ __('Permissions') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:roles.index') }}" key="t-roles">{{ __('navbar.roles') }}</a></li>
            <li><a href="{{ route('admin:permissions.index') }}"
                    key="t-permissions">{{ __('navbar.permissions') }}</a>
            </li>
        </ul>
    </li>
@endif

@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li>

        <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-wrench"></i>
            <span key="t-settings">{{ __('Paramètres') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li>
                <a href="{{ route('admin:settings.index') }}" key="t-company">{{ __('Société') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin:settings.invoice') }}" key="t-invoice">{{ __('Facture') }}
                </a>
            </li>
        </ul>
    </li>
@endif
