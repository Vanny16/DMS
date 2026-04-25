<header class="bg-white border-bottom py-3 shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Left Side: Hamburger -->
        <div class="d-flex align-items-center">
            <i class="bi bi-list fs-3 text-dark" style="cursor: pointer;"></i>
        </div>

        <!-- Right Side: Icons & User Info -->
        <div class="d-flex align-items-center gap-4">

            <!-- Mail Icon -->
            <a href="mailto:admin@piepdvo.com" class="d-flex align-items-center text-dark text-decoration-none">
                <i class="bi bi-envelope-fill fs-5"></i>
                <span class="ms-1">Mail</span>
            </a>    

            <!-- Grid Icon -->
            <a href="#" class="text-dark text-decoration-none">
                <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
            </a>

            <!-- User Name with Dropdown -->
            <div class="dropdown text-dark d-flex align-items-center">
                <span class="fw-bold text-dark me-2">
                    {{ Auth::user()->usrUserName ?? session('usrUserName') ?? 'Guest' }}
                </span>

                <a href="#" class="dropdown-toggle text-dark fw-bold text-decoration-none" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-caret-down-fill"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    @if(Auth::check())
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login.page') }}">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>