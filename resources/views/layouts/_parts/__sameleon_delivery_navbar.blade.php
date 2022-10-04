<li>
    <a href="{{ route('delivery:home') }}" class="waves-effect">
        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
    </a>
</li>

<li class="menu-title" key="t-stock">Stock</li>
<li>
    <a href="{{ route('delivery:products.index') }}">

        <i class="bx bx-store"></i>
        <span key="t-products">{{ __('Produits') }}</span>
    </a>
</li>

<li>
    <a href="{{ route('delivery:stock.index') }}" class="waves-effect">

        <i class="bx bxs-box "></i>
 
            <span class="badge rounded-pill bg-danger float-end"> 5 </span>
      
        <span key="t-stock">{{ __('Stock') }}</span>
    </a>

</li>

<li class="menu-title" key="t-commands">Commandes</li>

<li>
    <a href="{{ route('delivery:commands.index') }}" class="waves-effect">


        <i class="bx bx-cart-alt"></i>

        <span class="badge rounded-pill bg-info float-end"> 2</span>

        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>


<li class="menu-title" key="t-invoices">Factures</li>

<li>
    <a href="{{ route('delivery:invoices.index') }}">
        <i class="bx bx-file"></i>

        <span class="badge rounded-pill bg-info float-end">{{ 1 }}</span>

        <span key="t-invoices">{{ __('Factures') }}</span>
    </a>
</li>
<li>
    <a href="{{ route('delivery:payments.index') }}">
        <i class="bx bx-money"></i>
        <span key="t-payments">{{ __('Paiements') }}</span>
    </a>
</li>



<li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>

<li>
    <a href="{{ route('delivery:delivery.index') }}">
        <i class='bx bxs-truck'></i>
        <span key="t-subdelivery">{{ __('Sous Livreurs') }}</span>
    </a>
</li>
