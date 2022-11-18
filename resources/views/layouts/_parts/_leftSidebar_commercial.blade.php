<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">
             
                <li class="menu-title" key="t-menu">Menu</li>

                @if (auth('delivery')->check())
                    @if (delivery()->hasRole('DeliveryEntreprise'))
                        @include('layouts._parts.__sameleon_delivery_navbar')
                    @endif
                    @if (delivery()->hasRole('SubDelivery') || delivery()->hasRole('Delivery'))
                        @include('layouts._parts.__sameleon_sub_delivery_navbar')
                    @endif
                @else
                    @include('layouts._parts.__sameleon_admin')
                @endif


            </ul>

        </div>
    </div>
</div>
