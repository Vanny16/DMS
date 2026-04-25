<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="main-header navbar navbar-expand navbar-white navbar-light" id="mh-color">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" id="menuNav"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-user-circle"></i>
                    {{ session('name') }}
                    <i class="fas fa-caret-down"></i></a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Account Management</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal">
                        <i class="fas fa-key mr-2"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" id="logout">
                        <i class="fas fa-sign-out-alt mr-2"></i> Sign-out
                    </a>
                </div>
            </li>
        </ul>
</nav>


<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="changePasswordForm" method="POST" action="/change-password">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="newPassword_confirmation"
                            required>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('logout').addEventListener('click', function () {
        localStorage.clear();
        sessionStorage.clear();
        document.cookie.split(";").forEach(function (c) {
            document.cookie = c.trim().split("=")[0] + '=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
        });

        window.location.href = '/login';
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>