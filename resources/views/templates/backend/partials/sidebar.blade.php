<style>
    .main-sidebar {
        background: linear-gradient(180deg, #0f172a 0%, #111827 45%, #0b1120 100%) !important;
    }

    .brand-link {
        border-bottom: 1px solid rgba(255,255,255,.08) !important;
        padding: 18px 14px;
    }

    .brand-link .brand-text {
        font-weight: 700 !important;
        letter-spacing: .8px;
        color: #fff;
    }

    .brand-image {
        background: #fff;
        padding: 3px;
    }

    .sidebar .user-panel {
        background: rgba(255,255,255,.06);
        border-radius: 16px;
        padding: 14px;
        margin: 14px 10px;
        border-bottom: none !important;
    }

    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd, #20c997);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-right: 10px;
    }

    .user-name {
        font-weight: 700;
        color: #fff;
        font-size: 14px;
    }

    .user-role {
        color: rgba(255,255,255,.55);
        font-size: 12px;
    }

    .nav-sidebar .nav-header {
        color: rgba(255,255,255,.45);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .8px;
        padding: 18px 18px 8px;
        text-transform: uppercase;
    }

    .nav-sidebar .nav-link {
        border-radius: 14px;
        margin: 4px 10px;
        padding: 11px 14px;
        color: rgba(255,255,255,.75);
        transition: all .2s ease;
    }

    .nav-sidebar .nav-link:hover {
        background: rgba(255,255,255,.08);
        color: #fff;
        transform: translateX(3px);
    }

    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #0d6efd, #20c997) !important;
        color: #fff !important;
        box-shadow: 0 8px 20px rgba(13,110,253,.25);
    }

    .nav-sidebar .nav-icon {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .sidebar-badge {
        margin-left: auto;
        border-radius: 30px;
        padding: 4px 8px;
        font-size: 11px;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" target="_BLANK" class="brand-link d-flex align-items-center">
        <img src="{{ asset('css/DNRSA.png') }}" alt="PIEP Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text ml-2">INFINIT DMS</span>
    </a>

    <div class="sidebar">

        <div class="user-panel d-flex align-items-center">
            <div class="user-avatar">
                {{ strtoupper(substr(session('name') ?? 'G', 0, 1)) }}
            </div>
            <div>
                <div class="user-name">{{ session('name') ?? 'GUEST' }}</div>
                <div class="user-role">
                    {{ session('is_admin') == '1' ? 'Administrator' : 'User' }}
                </div>
            </div>
        </div>

     <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false">

        {{-- MAIN MENU --}}
        <li class="nav-header">Main Menu</li>

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ action('AdminController@main') }}"
               class="nav-link {{ request()->routeIs('admin.main') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>

        {{-- S.I.P --}}
        <li class="nav-item">
            <a href="{{ route('sip.main') }}"
               class="nav-link {{ request()->routeIs('sip.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>S.I.P</p>
            </a>
        </li>

        {{-- MANAGER WITH SUB MENU --}}
    @php
        $manageActive =
            request()->routeIs('manage_users.*') ||
            request()->routeIs('manage_schools.*');
    @endphp

    <li class="nav-item has-treeview {{ $manageActive ? 'menu-open' : '' }}">

        <a href="#"
        class="nav-link">

            <i class="nav-icon fas fa-user-cog"></i>

            <p>
                Manage
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            {{-- Users --}}
            <li class="nav-item">
                <a href="{{ route('manage_users.main') }}"
                class="nav-link {{ request()->routeIs('manage_users.*') ? 'active' : '' }}">

                    <i class="far fa-user nav-icon"></i>
                    <p>Users</p>
                </a>
            </li>

            {{-- Schools --}}
            <li class="nav-item">
                <a href="{{ route('manage_schools.main') }}"
                class="nav-link {{ request()->routeIs('manage_schools.*') ? 'active' : '' }}">

                    <i class="fas fa-school nav-icon"></i>
                    <p>Schools</p>
                </a>
            </li>

        </ul>
    </li>

        {{-- QUICK LINKS --}}
        <li class="nav-header">Quick Links</li>

    </ul>
</nav>
    </div>
</aside>
