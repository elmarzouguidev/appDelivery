<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                @include('layouts._parts.__sameleon')


                <li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>
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
                        <li><a href="{{-- route('admin:permissions-roles.index') --}}"
                                key="t-roles">{{ __('navbar.roles') }}</a></li>
                        <li><a href="{{-- route('admin:permissions-roles.permissions') --}}"
                                key="t-permissions">{{ __('navbar.permissions') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{-- route('admin:admins') --}}" class="waves-effect">
                        <i class="bx bx-edit"></i>
                        <span key="t-settings">Settings</span>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</div>
