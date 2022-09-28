<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title" key="t-menu">Menu</li>

                @hasrole('DeliveryEntreprise')

                    @include('layouts._parts.__sameleon_delivery_navbar')

                @else

                    @include('layouts._parts.__sameleon_admin')
                    
                @endhasrole

            </ul>

        </div>
    </div>
</div>
