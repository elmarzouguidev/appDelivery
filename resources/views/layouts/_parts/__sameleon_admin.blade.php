<li>
    <a href="{{ route('sameleon:home') }}" class="waves-effect">
        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
    </a>
</li>

<li class="menu-title" key="t-pages">Commandes</li>

<li>
    <a href="{{ route('sameleon:commands.index') }}" class="waves-effect">

        <i class="bx bx-cart-alt"></i>
        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>
<li class="menu-title" key="t-pages">Produits</li>

<li>
    <a href="{{ route('sameleon:products.index') }}">
        <i class="bx bx-store"></i>
        <span key="t-products">{{ __('Produits') }}</span>
    </a>
    {{-- <ul class="sub-menu" aria-expanded="false">
        <li>
            <a href="{{ route('sameleon:products.index') }}"
                key="t-products">{{ __('Produits') }}
            </a>
        </li>
        <li>
            <a href="{{ route('sameleon:products.create') }}"
                key="t-products">{{ __('Ajouter un Produit') }}
            </a>
        </li>
    </ul> --}}
</li>


<li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>

<li>
    <a href="{{ route('sameleon:clients.index') }}" class="waves-effect">

        <i class="bx bx-user-circle"></i>
        <span key="t-clients">{{ __('Clients') }}</span>
    </a>

</li>

<li>
    <a href="{{ route('sameleon:cities.index') }}" class="waves-effect">

        <i class="bx bx-user-circle"></i>
        <span key="t-cities">{{ __('Villes') }}</span>
    </a>

</li>

<li>
    <a href="{{ route('sameleon:admins.index') }}" class="waves-effect">

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
        <li><a href="{{ route('sameleon:roles.index') }}" key="t-roles">{{ __('navbar.roles') }}</a></li>
        <li><a href="{{ route('sameleon:permissions.index') }}"
                key="t-permissions">{{ __('navbar.permissions') }}</a>
        </li>
    </ul>
</li>

<li>
    <a href="{{ route('sameleon:settings.index') }}" class="waves-effect">
        <i class="bx bx-wrench"></i>
        <span key="t-settings">Settings</span>
    </a>

</li>
