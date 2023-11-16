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
    $urlSocioEconomicStudy = basename(route('socio-economic-index'));
    $isSocioEconomicStudy = Request::is($urlSocioEconomicStudy, $urlSocioEconomicStudy.$nested);
    $urlSocioSocialWorkerIndex = basename(route('social-worker-index'));
    $isSocioSocialWorkerIndex = Request::is($urlSocioSocialWorkerIndex, $urlSocioSocialWorkerIndex.$nested);
    $urlPatients = basename(route('patients-index'));
    $isPatients = Request::is($urlPatients, $urlPatients.$nested);
@endphp
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        @can('Dashboard')
            <li
                class="sidebar-item {{ $isDashboard ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Tablero</span>
                </a>
            </li>
        @endcan
        @can('Módulo usuarios')
            <li
                class="sidebar-item {{ $isUsers ? 'active' : '' }}">
                <a href="{{ route('users') }}" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        @endcan
        @can('Módulo formularios')
            <li
                class="sidebar-item {{ $isFormSettings ? 'active' : '' }}">
                <a href="{{ route('forms-settings') }}" class='sidebar-link'>
                    <i class="bi bi-ui-checks"></i>
                    <span>Formularios</span>
                </a>
            </li>
        @endcan
        @can('Lista pacientes')
            <li
                class="sidebar-item {{ $isPatients ? 'active' : '' }}">
                <a href="{{ route('patients-index') }}" class='sidebar-link'>
                    <i class="bi bi-person-fill-add"></i>
                    <span>Pacientes</span>
                </a>
            </li>
        @endcan
        @can('Fichas médicas')
            <li
                class="sidebar-item {{ $isMedicModule ? 'active' : '' }}">
                <a href="{{ route('initial-data-medic') }}" class='sidebar-link'>
                    <i class="bi bi-clipboard2-pulse"></i>
                    <span>Fichas médicas</span>
                </a>
            </li>
        @endcan
        @can('Fichas trabajo social')
            <li
                class="sidebar-item {{ $isSocioSocialWorkerIndex ? 'active' : '' }}">
                <a href="{{ route('social-worker-index') }}" class='sidebar-link'>
                    <i class="bi bi-ui-checks-grid"></i>
                    <span>Fichas trabajo social</span>
                </a>
            </li>
        @endcan
        @can('Estudios socioeconómicos')
            <li
                class="sidebar-item {{ $isSocioEconomicStudy ? 'active' : '' }}">
                <a href="{{ route('socio-economic-index') }}" class='sidebar-link'>
                    <i class="bi bi-ui-checks"></i>
                    <span>Estudios socioeconómicos</span>
                </a>
            </li>
        @endcan
        @can('Lista roles')
            <li
                class="sidebar-item {{ $isRoles ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" class='sidebar-link'>
                    <i class="bi bi-lock-fill"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endcan
        @can('Lista permisos')
            <li
                class="sidebar-item {{ $isPermissions ? 'active' : '' }}">
                <a href="{{ route('permissions.index') }}" class='sidebar-link'>
                    <i class="bi bi-key-fill"></i>
                    <span>Permisos</span>
                </a>
            </li>
        @endcan
    </ul>
</div>
