<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin:home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-info float-end">04</span> --}}
                        {{--<span key="t-dashboards">{{ __('navbar.dashboard') }}</span>---}}
                    </a>
                </li>

                @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))

                @endif

                <li class="menu-title" key="t-pages">{{ __('navbar.authentification') }}</li>

                <li>
                    <a href="{{ route('admin:admins') }}" class="waves-effect">
        
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">{{ __('navbar.authentification') }}</span>
                    </a>
        
                </li>

                <li class="menu-title" key="t-components">{{ __('navbar.advanced') }}</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">

                        <span key="t-authentication">{{ __('navbar.roles_permissions') }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin:permissions-roles.index') }}"
                                key="t-login">{{ __('navbar.roles') }}</a></li>
                        <li><a href="{{ route('admin:permissions-roles.permissions') }}"
                                key="t-login">{{ __('navbar.permissions') }}</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ route('admin:admins') }}" class="waves-effect">
                        <span key="t-settings">Settings</span>
                    </a>
        
                </li>
            </ul>
        </div>
    </div>
</div>
