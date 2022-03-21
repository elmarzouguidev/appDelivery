<li>
    <a href="{{ route('admin:home') }}" class="waves-effect">
        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
    </a>
</li>

<li class="menu-title" key="t-commands">Commandes</li>

<li>
    <a href="{{ route('admin:commands.index') }}" class="waves-effect">

        <i class="bx bx-cart-alt"></i>
        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>
<li class="menu-title" key="t-products">Produits</li>

<li>
    <a href="{{ route('admin:products.index') }}">
        <i class="bx bx-store"></i>
        <span key="t-products">{{ __('Produits') }}</span>
    </a>
    {{-- <ul class="sub-menu" aria-expanded="false">
        <li>
            <a href="{{ route('admin:products.index') }}"
                key="t-products">{{ __('Produits') }}
            </a>
        </li>
        <li>
            <a href="{{ route('admin:products.create') }}"
                key="t-products">{{ __('Ajouter un Produit') }}
            </a>
        </li>
    </ul> --}}
</li>

@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    <li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>

    <li>
        <a href="{{ route('admin:clients.index') }}" class="waves-effect">

            <i class="bx bx-user-circle"></i>
            <span key="t-clients">{{ __('Clients') }}</span>
        </a>

    </li>

    <li>
        <a href="{{ route('admin:cities.index') }}" class="waves-effect">

            <i class="bx bx-user-circle"></i>
            <span key="t-cities">{{ __('Villes') }}</span>
        </a>

    </li>

    <li>
        <a href="{{ route('admin:admins.index') }}" class="waves-effect">

            <i class="bx bx-user-circle"></i>
            <span key="t-authentication">{{ __('Authentification') }}</span>
        </a>

    </li>
    <li>
        <a href="javascript: void(0);" class="waves-effect">
            <i class="bx bx-lock"></i>
            <span key="t-authentication">{{ __('navbar.roles_permissions') }}</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('admin:roles.index') }}" key="t-roles">{{ __('navbar.roles') }}</a></li>
            <li><a href="{{ route('admin:permissions.index') }}"
                    key="t-permissions">{{ __('navbar.permissions') }}</a>
            </li>
        </ul>
    </li>
@endif
<li>
    <a href="{{ route('admin:settings.index') }}" class="waves-effect">
        <i class="bx bx-wrench"></i>
        <span key="t-settings">Settings</span>
    </a>

</li>
