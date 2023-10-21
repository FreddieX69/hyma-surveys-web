@php
    $nested = '/*';
    $urlDashboard = basename(route('dashboard'));
    $isDashboard = Request::is($urlDashboard, $urlDashboard.$nested);
    $urlUsers = basename(route('users'));
    $isUsers = Request::is($urlUsers, $urlUsers.$nested);
    $urlRoles = basename(route('roles.index'));
    $isRoles = Request::is($urlRoles, $urlRoles.$nested);
    $urlPermissions = basename(route('permissions.index'));
    $isPermissions = Request::is($urlPermissions, $urlPermissions.$nested);
    $urlFormSettings = basename(route('forms-settings'));
    $isFormSettings = Request::is($urlFormSettings, $urlFormSettings.$nested);
    $urlMedicModule = basename(route('initial-data-medic'));
    $isMedicModule = Request::is($urlMedicModule, $urlMedicModule.$nested);
@endphp
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li
            class="sidebar-item {{ $isDashboard ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ $isUsers ? 'active' : '' }}">
            <a href="{{ route('users') }}" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Usuarios</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ $isFormSettings ? 'active' : '' }}">
            <a href="{{ route('forms-settings') }}" class='sidebar-link'>
                <i class="bi bi-ui-checks"></i>
                <span>Formularios</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ $isMedicModule ? 'active' : '' }}">
            <a href="{{ route('initial-data-medic') }}" class='sidebar-link'>
                <i class="bi bi-clipboard2-pulse"></i>
                <span>Ficha médica</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ $isRoles ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}" class='sidebar-link'>
                <i class="bi bi-lock-fill"></i>
                <span>Roles</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ $isPermissions ? 'active' : '' }}">
            <a href="{{ route('permissions.index') }}" class='sidebar-link'>
                <i class="bi bi-key-fill"></i>
                <span>Permisos</span>
            </a>
        </li>

{{--        <li--}}
{{--            class="sidebar-item  has-sub">--}}
{{--            <a href="#" class='sidebar-link'>--}}
{{--                <i class="bi bi-stack"></i>--}}
{{--                <span>Components</span>--}}
{{--            </a>--}}
{{--            <ul class="submenu ">--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Alert</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Badge</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Breadcrumb</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Button</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Card</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Carousel</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Collapse</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Dropdown</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">List Group</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Modal</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Navs</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Pagination</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Progress</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Spinner</a>--}}
{{--                </li>--}}
{{--                <li class="submenu-item ">--}}
{{--                    <a href="/">Tooltip</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

    </ul>
</div>
