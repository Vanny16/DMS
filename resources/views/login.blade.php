@extends('templates.frontend.partials.partials.loginhead')
@extends('templates.frontend.partials.partials.loginscript')
@extends('templates.backend.layouts.themes.login')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #20c997);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-card-modern {
            width: 100%;
            max-width: 1180px;
            min-height: 680px;
            background: #fff;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0, 0, 0, .20);
            display: flex;
            position: relative;
        }

        .login-brand-panel {
            width: 52%;
            background:
                linear-gradient(135deg,
                    rgba(13, 110, 253, .92),
                    rgba(32, 201, 151, .85)),
                url('{{ asset('css/DNRSA.png') }}');

            background-size: cover;
            background-position: center;
            position: relative;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
        }

        .login-brand-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            backdrop-filter: blur(4px);
        }

        .login-brand-panel>* {
            position: relative;
            z-index: 2;
        }

        .brand-badge {
            width: 70px;
            height: 70px;
            border-radius: 22px;
            background: rgba(255, 255, 255, .18);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 28px;
            box-shadow: 0 10px 30px rgba(255, 255, 255, .12);
        }

        .brand-title {
            font-size: 50px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 18px;
            letter-spacing: -.5px;
        }

        .brand-text {
            font-size: 18px;
            line-height: 1.8;
            opacity: .96;
            max-width: 480px;
        }

        .brand-footer {
            font-size: 14px;
            opacity: .92;
            font-weight: 500;
        }

        .login-form-panel {
            width: 48%;
            padding: 70px 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .login-logo {
            width: 115px;
            height: 115px;
            object-fit: contain;
            border-radius: 30px;
            background: #fff;
            padding: 12px;
            box-shadow: 0 18px 40px rgba(13, 110, 253, .14);
            margin-bottom: 28px;
        }

        .login-title {
            font-size: 38px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }

        .login-subtitle-modern {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .modern-label {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 10px;
        }

        .input-group-modern {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            z-index: 5;
            font-size: 15px;
            pointer-events: none;
        }

        .form-control-modern {
            height: 56px;
            width: 100%;
            border-radius: 18px;
            border: 1px solid #dbe3ea;
            padding-left: 52px !important;
            padding-right: 18px;
            font-size: 15px;
            background: #f9fafb;
            transition: all .2s ease;
            color: #111827;
        }

        .form-control-modern::placeholder {
            color: #9ca3af;
        }

        .form-control-modern:focus {
            background: #fff;
            border-color: #20c997;
            box-shadow: 0 0 0 5px rgba(32, 201, 151, .14);
            outline: none;
        }

        .btn-login-modern {
            height: 58px;
            width: 100%;
            border-radius: 18px;
            border: none;
            background: linear-gradient(135deg, #0d6efd, #20c997);
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            letter-spacing: .3px;
            box-shadow: 0 18px 40px rgba(13, 110, 253, .28);
            transition: all .2s ease;
            margin-top: 10px;
        }

        .btn-login-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 45px rgba(13, 110, 253, .35);
            color: #fff;
        }

        .forgot-link-modern {
            display: inline-block;
            margin-top: 22px;
            color: #0d6efd;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .forgot-link-modern:hover {
            color: #20c997;
            text-decoration: none;
        }

        .alert-modern {
            border: none;
            border-radius: 16px;
            font-size: 14px;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        @media (max-width: 992px) {

            .login-card-modern {
                flex-direction: column;
                min-height: auto;
            }

            .login-brand-panel,
            .login-form-panel {
                width: 100%;
            }

            .login-brand-panel {
                min-height: 320px;
                padding: 40px;
            }

            .login-form-panel {
                padding: 40px 28px;
            }

            .brand-title {
                font-size: 38px;
            }

            .brand-text {
                font-size: 15px;
            }

            .login-title {
                font-size: 30px;
            }
        }

        @media (max-width: 576px) {

            .login-wrapper {
                padding: 15px;
            }

            .login-card-modern {
                border-radius: 24px;
            }

            .login-brand-panel {
                padding: 30px;
            }

            .brand-title {
                font-size: 30px;
            }

            .brand-text {
                font-size: 14px;
            }

            .login-form-panel {
                padding: 35px 22px;
            }

            .login-logo {
                width: 90px;
                height: 90px;
            }

            .login-title {
                font-size: 26px;
            }

            .form-control-modern {
                height: 52px;
            }

            .btn-login-modern {
                height: 54px;
            }
        }

        .login-logo {
            width: 115px;
            height: 115px;
            object-fit: contain;
            border-radius: 30px;
            background: #fff;
            padding: 12px;
            box-shadow: 0 18px 40px rgba(13, 110, 253, .14);
            margin: 0 auto 28px auto;
            display: block;
        }
    </style>

    <div class="login-wrapper">
        <div class="login-card-modern">

            <div class="login-brand-panel">
                <div>
                    <div class="brand-badge">
                        <i class="fa fa-folder-open"></i>
                    </div>

                    <div class="brand-title">
                        Welcome to<br>
                        Document Management System
                    </div>

                    <div class="brand-text">
                        Access your dashboard, manage procurement documents, monitor submissions, and generate reports
                        securely.
                    </div>
                </div>

                <div class="brand-footer">
                    {{-- Powered by Vanny --}}
                </div>
            </div>

            <div class="login-form-panel">
                <div class="text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset('css/DNRSA.png') }}" class="login-logo mx-auto d-block" alt="School Logo">

                    <div class="login-title">Sign In</div>
                    <div class="login-subtitle-modern">Please login to continue to your account.</div>
                </div>

                @if (session('errorMessage'))
                    <div class="alert alert-danger alert-modern text-center mb-3">
                        {{ session('errorMessage') }}
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-success alert-modern text-center mb-3">
                        {!! session('message') !!}
                    </div>
                @endif

                <form method="POST" action="{{ action([App\Http\Controllers\LoginController::class, 'validateUser']) }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="modern-label">Username</label>
                        <div class="input-group-modern">
                            <i class="fa fa-user input-icon"></i>
                            <input type="text" class="form-control form-control-modern" name="usrUserName"
                                placeholder="Enter username" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="modern-label">Password</label>
                        <div class="input-group-modern">
                            <i class="fa fa-lock input-icon"></i>
                            <input type="password" class="form-control form-control-modern" name="usrPassword"
                                placeholder="Enter password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login-modern">
                        <i class="fa fa-sign-in mr-2"></i> Login
                    </button>

                    <div class="text-center">
                        <a href="#" class="forgot-link-modern" data-bs-toggle="modal"
                            data-bs-target="#forgotPasswordModal">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
