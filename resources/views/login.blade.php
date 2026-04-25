@extends('templates.frontend.partials.partials.loginhead')
@extends('templates.frontend.partials.partials.loginscript')
@extends('templates.backend.layouts.themes.login')
@section('content')

    <div class="login-container">
        <div class="login-card">
            <div class="login-left"></div>

            <div class="login-right">
                <img src="{{ asset('css/schoolLogin2.jpg') }}" class="logo-img" alt="School Logo">
                <div class="login-subtitle">PLEASE LOGIN TO CONTINUE</div>

                @if(session('errorMessage'))
                    <div class="alert alert-danger text-center mb-3">
                        {{ session('errorMessage') }}
                    </div>
                @endif

                @if(session('message'))
                    <div class="alert alert-success text-center mb-3">
                        {!! session('message') !!}
                    </div>
                @endif

                <form method="POST" action="{{ action([App\Http\Controllers\LoginController::class, 'validateUser']) }}"
                    class="w-100">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text" class="form-control" name="usrUserName" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="usrPassword" required>
                    </div>

                    <button type="submit" class="btn btn-login btn-block">
                        <i class="fa fa-sign-in"></i> Login
                    </button>

                    <a href="#" class="forgot-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                        Forgot Password?
                    </a>
                </form>
            </div>
        </div>
@endsection