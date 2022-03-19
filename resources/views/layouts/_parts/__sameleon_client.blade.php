<li>
    <a href="{{ route('client:home') }}" class="waves-effect">
        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
    </a>
</li>

<li class="menu-title" key="t-pages">Commandes</li>

<li>
    <a href="{{ route('client:commands.index') }}" class="waves-effect">

        <i class="bx bx-cart-alt"></i>
        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>
<li class="menu-title" key="t-pages">Produits</li>

<li>
    <a href="javascript: void(0);" class="waves-effect has-arrow">
        <i class="bx bx-store"></i>
        <span key="t-products">{{ __('Produits') }}</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li>
            <a href="{{ route('client:products.index') }}" key="t-login">{{ __('Produits') }}
            </a>
        </li>
        <li>
            <a href="{{ route('client:products.create') }}" key="t-login">{{ __('Ajouter un Produit') }}
            </a>
        </li>
    </ul>
</li>
