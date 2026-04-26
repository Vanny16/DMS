@extends('templates.backend.layouts.main')

@section('content')
    <style>
        .sip-page-header {
            background: linear-gradient(135deg, #0d6efd, #20c997);
            border-radius: 18px;
            padding: 25px;
            color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        .sip-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .sip-card .card-header {
            background: #fff;
            border-bottom: 1px solid #eef0f3;
            padding: 18px 22px;
        }

        .sip-table thead th {
            background: #f8fafc;
            color: #495057;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .4px;
            border-bottom: none;
        }

        .sip-table tbody tr {
            transition: .2s ease;
        }

        .sip-table tbody tr:hover {
            background: #f4fbff;
            transform: scale(1.002);
        }

        .file-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #e9f3ff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-badge {
            padding: 7px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            background: #fff3cd;
            color: #856404;
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
            background: linear-gradient(135deg, #0d6efd, #20c997);
            color: #fff;
        }

        .modal-header .close {
            color: #fff;
            opacity: 1;
        }

        .form-control {
            border-radius: 10px;
        }

        .upload-box {
            border: 2px dashed #ced4da;
            border-radius: 14px;
            padding: 18px;
            background: #f8fafc;
        }

        .badge {
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-secondary {
            background: #e2e3e5;
            color: #383d41;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">

            <div class="sip-page-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h2 class="mb-1 font-weight-bold">SIP Management</h2>
                        <p class="mb-0">Manage School Improvement Plan submissions, budget allocation, and approvers.</p>
                    </div>

                    <button class="btn btn-light btn-modern mt-3 mt-md-0" data-toggle="modal" data-target="#createSipModal">
                        <i class="fa fa-plus"></i> Create SIP
                    </button>
                </div>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card sip-card">
                <div class="card-header">
                    <h5 class="mb-0 font-weight-bold">
                        <i class="fa fa-folder-open text-primary"></i> SIP List
                    </h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-hover sip-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>File</th>
                                    <th>Budget Allocation</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sip_list as $sip)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="file-box">
                                                <div class="file-icon">
                                                    <i class="fa fa-file-text-o"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $sip->file_name ?? 'N/A' }}</strong>
                                                    <br>
                                                    <small class="text-muted">Uploaded SIP document</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <strong>{{ $sip->budget_allocation ?? 'N/A' }}</strong>
                                        </td>

                                        <td>
                                            @php
                                                $status = strtolower($sip->status ?? '');

                                                if ($status == 'pending' || $status == 'for approval') {
                                                    $badgeClass = 'badge-warning';
                                                } elseif ($status == 'under review' || $status == 'processing') {
                                                    $badgeClass = 'badge-info';
                                                } elseif ($status == 'approved' || $status == 'completed') {
                                                    $badgeClass = 'badge-success';
                                                } elseif ($status == 'returned' || $status == 'rejected') {
                                                    $badgeClass = 'badge-danger';
                                                } else {
                                                    $badgeClass = 'badge-secondary';
                                                }
                                            @endphp

                                            <span class="badge {{ $badgeClass }} px-3 py-2">
                                                {{ ucfirst($sip->status ?? 'N/A') }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ route('sip.manage', $sip->sip_id) }}"
                                                class="btn btn-info btn-sm btn-modern">
                                                <i class="fa fa-cog"></i> Manage
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="createSipModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <form method="POST" action="{{ route('sip.save') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fa fa-plus-circle"></i> Create SIP
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label>Upload SIP File</label>
                                            <div class="upload-box">
                                                <input type="file" name="file" class="form-control" required>
                                                <small class="text-muted">Accepted files: PDF, DOC, DOCX</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Budget Allocation</label>
                                            <input type="text" name="budget_allocation" class="form-control"
                                                placeholder="Enter budget allocation" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Select Approvers</label>
                                            <select name="approver_ids[]" class="form-control approver-select" multiple
                                                required>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->user_id }}">
                                                        {{ $user->last_name }}, {{ $user->first_name }}
                                                        {{ $user->initial }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Select maximum of 3 approvers.</small>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success btn-modern">
                                            <i class="fa fa-save"></i> Submit
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
