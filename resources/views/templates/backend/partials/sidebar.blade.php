<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" target="_BLANK" class="brand-link">
        <img src="{{ asset('images/piep.png') }}" alt="PIEP Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">INFINIT</span>
    </a>
    <div class="sidebar">
        <div class="user-panel d-flex align-items-center mt-3 pb-3 mb-3">

            <div class="info">
                <a href="#" class="d-block fw-bold text-white">

                    {{ session('name') ?? 'GUEST' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">


                <li class="nav-item">
                    <a href="{{ action('AdminController@main') }}"
                        class="nav-link {{ request()->routeIs('admin.main') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('news.index') }}"
                        class="nav-link {{ request()->routeIs('news.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>News</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sip.main') }}"
                        class="nav-link {{ request()->routeIs('sip.main') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>S.I.P</p>
                    </a>
                </li>

                {{-- <li
                    class="nav-item has-treeview {{ request()->routeIs('report.showForm', 'report2.form') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('report.showForm', 'report2.form') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                           S.I.P
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('report.showForm') }}"
                                class="nav-link {{ request()->routeIs('report.showForm') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report Card 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('report2.form') }}"
                                class="nav-link {{ request()->routeIs('report2.form') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report Card 2</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                @if (session('is_admin') == '1')
                    <li class="nav-header">Manage Members</li>
                    <li class="nav-item">
                        <a href="{{ action('MemberController@list') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Existing Members</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ action('MemberController@approval') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>For Approval</p>
                            @if (get_approval_count() > 0)
                                <span class="badge badge-warning">{{ get_approval_count() }}</span>
                            @endif
                        </a>
                    </li>
                @else
                    @if (session('mem_is_good_standing') == '1')
                        <li class="nav-header">PIEP Election</li>
                        <li class="nav-item">
                            <a href="{{ action('ElectionController@nominate') }}" class="nav-link">
                                <i class="nav-icon fa fa-tasks"></i>
                                <p>Nominate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action('ElectionController@elect') }}" class="nav-link">
                                <i class="nav-icon fa fa-tasks"></i>
                                <p>Vote (Board Members)</p>
                            </a>
                        </li>
                        @if (is_board_member() == true)
                            <li class="nav-item">
                                <a href="{{ action('ElectionController@elect2') }}" class="nav-link">
                                    <i class="nav-icon fa fa-tasks"></i>
                                    <p>Vote (Officers)</p>
                                </a>
                            </li>
                        @endif
                    @endif
                @endif

                <li class="nav-header">QUICK LINKS</li>
                <li class="nav-item">

                </li>
            </ul>
        </nav>
    </div>
</aside>
