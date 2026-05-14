@extends('templates.backend.layouts.main')

@section('content')
    <style>
        .page-header-modern {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            border-radius: 18px;
            padding: 25px;
            color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        .modern-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .modern-card .card-header {
            background: #fff;
            border-bottom: 1px solid #eef0f3;
            padding: 18px 22px;
        }

        .modern-table thead th {
            background: #f8fafc;
            color: #495057;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .4px;
            border-bottom: none;
        }

        .modern-table tbody tr {
            transition: .2s ease;
        }

        .modern-table tbody tr:hover {
            background: #f4f8ff;
            transform: scale(1.002);
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #e9f2ff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .badge-active {
            background: #d4edda;
            color: #155724;
            padding: 7px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-modern {
            border-radius: 30px;
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 600;
        }

        .modal-content {
            border: none;
            border-radius: 18px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
        }

        .modal-header .close {
            color: #fff;
            opacity: 1;
        }

        .form-control {
            border-radius: 10px;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">

            <div class="page-header-modern">
                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>
                        <h2 class="mb-1 font-weight-bold">
                            User Management
                        </h2>

                        <p class="mb-0">
                            Manage active users, user information, and system access.
                        </p>
                    </div>

                    <button class="btn btn-light btn-modern mt-3 mt-md-0" data-toggle="modal" data-target="#createUserModal">

                        <i class="fa fa-plus"></i> Add User
                    </button>

                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card modern-card">

                <div class="card-header">
                    <h5 class="mb-0 font-weight-bold">
                        <i class="fa fa-users text-primary"></i>
                        User List
                    </h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="example1" class="table table-hover modern-table">

                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th>User</th>
                                    <th>Position</th>

                                    <th>Email</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($users as $user)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="user-box">

                                                <div class="user-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>

                                                <div>
                                                    <strong>
                                                        {{ $user->last_name }},
                                                        {{ $user->first_name }}
                                                        {{ $user->initial }}
                                                    </strong>

                                                    <br>

                                                    <small class="text-muted">
                                                        User ID:
                                                        {{ $user->user_id }}
                                                    </small>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            {{ $user->user_pos ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $user->email ?? 'N/A' }}
                                        </td>

                                        <td>
                                            <span class="badge badge-active">
                                                Active
                                            </span>
                                        </td>

                                        <td>

                                            <button class="btn btn-info btn-sm btn-modern">
                                                <i class="fa fa-edit"></i>
                                                Manage
                                            </button>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- ADD USER MODAL --}}
    <div class="modal fade" id="createUserModal">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form method="POST" action="{{ route('manage-users.save') }}">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fa fa-user-plus"></i>
                        Add New User
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        {{-- FIRST NAME --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>First Name</label>

                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                        </div>

                        {{-- LAST NAME --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Last Name</label>

                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>

                        {{-- INITIAL --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Initial</label>

                                <input type="text" name="initial" class="form-control" placeholder="M.I">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>

                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        {{-- POSITION --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Position</label>

                                <select name="position_id" class="form-control" required>

                                    <option value="">-- Select Position --</option>

                                    @foreach ($positions as $position)
                                        <option value="{{ $position->position_id }}">
                                            {{ $position->position }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        {{-- PASSWORD --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>

                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password</label>

                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                    </div>

                      <div class="row">
                        {{-- user type --}}
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Select user type</label>

                                <select name="user_type_id" class="form-control" required>

                                    <option value="">-- Select Position --</option>

                                    @foreach ($user_types as $user_type)
                                        <option value="{{ $user_type->user_type_id }}">
                                            {{ $user_type->user_type }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                    </div>


                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success btn-modern">

                        <i class="fa fa-save"></i>
                        Save User
                    </button>

                    <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">

                        Cancel
                    </button>

                </div>

                </form>

            </div>

        </div>

    </div>
@endsection
