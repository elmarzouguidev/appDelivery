<li>
    <a href="{{ route('delivery:home') }}" class="waves-effect">
        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
    </a>
</li>


<li class="menu-title" key="t-commands">Commandes</li>

<li>
    <a href="{{ route('delivery:commands.index') }}" class="waves-effect">


        <i class="bx bx-cart-alt"></i>

        <span class="badge rounded-pill bg-info float-end">{{ $sub_delivery_total_new_command ?? '0' }} </span>

        <span key="t-commands">{{ __('Commandes') }}</span>
    </a>

</li>


