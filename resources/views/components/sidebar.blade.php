@php
    $nested = '/*';
    $urlDashboard = basename(route('dashboard'));
    $isDashboard = Request::is($urlDashboard, $urlDashboard.$nested);
@endphp
<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li
            class="sidebar-item active ">
            <a href="index.html" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li
            class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Components</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/">Alert</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Badge</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Breadcrumb</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Button</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Card</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Carousel</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Collapse</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Dropdown</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">List Group</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Modal</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Navs</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Pagination</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Progress</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Spinner</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Tooltip</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-collection-fill"></i>
                <span>Extra Components</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="/">Avatar</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Sweet Alert</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Toastify</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Rating</a>
                </li>
                <li class="submenu-item ">
                    <a href="/">Divider</a>
                </li>
            </ul>
        </li>

        <li
            class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Layouts</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="layout-default.html">Default Layout</a>
                </li>
                <li class="submenu-item ">
                    <a href="layout-vertical-1-column.html">1 Column</a>
                </li>
                <li class="submenu-item ">
                    <a href="layout-vertical-navbar.html">Vertical Navbar</a>
                </li>
                <li class="submenu-item ">
                    <a href="layout-rtl.html">RTL Layout</a>
                </li>
                <li class="submenu-item ">
                    <a href="layout-horizontal.html">Horizontal Menu</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
