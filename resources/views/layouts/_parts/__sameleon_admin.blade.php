
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
    <a href="javascript: void(0);" class="waves-effect has-arrow">
        <i class="bx bx-cart-alt"></i>
        <span key="t-products">{{ __('Produits') }}</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li>
            <a href="{{-- route('sameleon:products.index') --}}"
                key="t-login">{{ __('Produits') }}
            </a>
        </li>
        <li>
            <a href="{{-- route('sameleon:products.create') --}}"
                key="t-login">{{ __('Ajouter Produit') }}
            </a>
        </li>
    </ul>
</li>


<li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>

<li>
    <a href="{{ route('sameleon:cities.index') }}" class="waves-effect">

        <i class="bx bx-user-circle"></i>
        <span key="t-cities">{{ __('Villes') }}</span>
    </a>

</li>

<li>
    <a href="{{-- route('sameleon:admins') --}}" class="waves-effect">

        <i class="bx bx-user-circle"></i>
        <span key="t-authentication">{{ __('navbar.authentification') }}</span>
    </a>

</li>
<li>
    <a href="javascript: void(0);" class="waves-effect">
        <i class="bx bx-lock"></i>
        <span key="t-authentication">{{ __('navbar.roles_permissions') }}</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li><a href="{{-- route('admin:permissions-roles.index') --}}" key="t-roles">{{ __('navbar.roles') }}</a></li>
        <li><a href="{{-- route('admin:permissions-roles.permissions') --}}" key="t-permissions">{{ __('navbar.permissions') }}</a>
        </li>
    </ul>
</li>

<li>
    <a href="{{-- route('admin:admins') --}}" class="waves-effect">
        <i class="bx bx-edit"></i>
        <span key="t-settings">Settings</span>
    </a>

</li>