<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title" key="t-menu">Menu</li>

                @auth('client')

                  @include('layouts._parts.__sameleon_client')

                @endauth

                @auth('web')

                  @include('layouts._parts.__sameleon_admin')

                @endauth
            </ul>
            
        </div>
    </div>
</div>
