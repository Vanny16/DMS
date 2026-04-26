@extends('templates.backend.layouts.main')

@section('content')

<style>
    .sip-page-header {
        background: linear-gradient(135deg, #0d6efd, #20c997);
        border-radius: 18px;
        padding: 25px;
        color: #fff;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,.12);
    }

    .sip-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .sip-card .card-header {
        background: #fff;
        border-bottom: 1px solid #eef0f3;
        padding: 18px 22px;
    }

    .btn-modern {
        border-radius: 30px;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .form-control {
        border-radius: 10px;
    }

    .file-preview-box {
        border: 2px dashed #ced4da;
        border-radius: 16px;
        padding: 18px;
        background: #f8fafc;
    }

    .file-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .file-icon {
        width: 45px;
        height: 45px;
        border-radius: 14px;
        background: #e9f3ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .status-badge {
        border-radius: 30px;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-warning-custom {
        background: #fff3cd;
        color: #856404;
    }

    .badge-info-custom {
        background: #d1ecf1;
        color: #0c5460;
    }

    .badge-success-custom {
        background: #d4edda;
        color: #155724;
    }

    .badge-danger-custom {
        background: #f8d7da;
        color: #721c24;
    }

    .badge-secondary-custom {
        background: #e2e3e5;
        color: #383d41;
    }

    .approver-card {
        border: 1px solid #eef0f3;
        border-radius: 14px;
        padding: 14px;
        background: #f8fafc;
        margin-bottom: 10px;
    }

    .approver-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #0d6efd;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }
</style>

@php
    switch ($sip->status_id) {
        case 1:
            $badgeClass = 'badge-warning-custom';
            break;
        case 2:
            $badgeClass = 'badge-info-custom';
            break;
        case 3:
            $badgeClass = 'badge-success-custom';
            break;
        case 4:
            $badgeClass = 'badge-danger-custom';
            break;
        default:
            $badgeClass = 'badge-secondary-custom';
    }
@endphp

<div class="content-header">
    <div class="container-fluid">
        <div class="sip-page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="mb-1 font-weight-bold">Manage SIP</h2>
                    <p class="mb-0">View, update, and manage SIP document details.</p>
                </div>

                <a href="{{ route('sip.main') }}" class="btn btn-light btn-modern mt-3 mt-md-0">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-8">
                <div class="card sip-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fa fa-file-text-o text-primary"></i> SIP Details
                        </h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sip.update', $sip->sip_id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Current SIP File</label>

                                <div class="file-preview-box">
                                    @if($sip->file_name)
                                        <div class="file-item">
                                            <div class="file-icon">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </div>

                                            <div>
                                                <strong>{{ $sip->file_name }}</strong><br>
                                                <a href="{{ asset('uploads/sip/' . $sip->file_name) }}" target="_blank" class="btn btn-info btn-sm btn-modern mt-2">
                                                    <i class="fa fa-eye"></i> View Uploaded File
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">No file uploaded</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Update SIP File</label>
                                <input type="file" name="file" class="form-control">
                                <small class="text-muted">Leave empty if you do not want to replace the current file.</small>
                            </div>

                            <div class="form-group">
                                <label>Budget Allocation</label>
                                <input type="text" name="budget_allocation" class="form-control"
                                    value="{{ $sip->budget_allocation }}" required>
                            </div>

                            <div class="form-group">
                                <label>Status</label><br>
                                <span class="status-badge {{ $badgeClass }}">
                                    {{ $sip->status ?? 'N/A' }}
                                </span>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success btn-modern">
                                    <i class="fa fa-save"></i> Update SIP
                                </button>

                                <a href="{{ route('sip.main') }}" class="btn btn-secondary btn-modern">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card sip-card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fa fa-line-chart text-success"></i> Manage Annual Improvement Plan
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="file-preview-box">
                            <p class="mb-2 font-weight-bold">Annual Improvement Plan File</p>
                            <p class="text-muted mb-3">Upload or update the Annual Improvement Plan related to this SIP.</p>

                            {{-- Uncomment when your route/controller is ready --}}

                            <form method="POST" action="{{ route('sip.aip.update', $sip->sip_id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Current Annual Improvement Plan File</label><br>

                                    @if($sip->aip_file)
                                        <a href="{{ asset('uploads/aip/' . $sip->aip_file) }}" target="_blank" class="btn btn-info btn-sm btn-modern">
                                            <i class="fa fa-eye"></i> View AIP File
                                        </a>
                                    @else
                                        <span class="text-muted">No AIP file uploaded</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Upload / Update Annual Improvement Plan</label>
                                    <input type="file" name="aip_file" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-modern">
                                    <i class="fa fa-upload"></i> Save Annual Improvement Plan
                                </button>
                            </form>


                            <button class="btn btn-primary btn-modern" disabled>
                                <i class="fa fa-upload"></i> Upload AIP
                            </button>
                            <small class="text-muted ml-2">Enable once AIP route/controller is ready.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card sip-card">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fa fa-users text-primary"></i> Approvers
                        </h5>
                    </div>

                    <div class="card-body">
                        @forelse($approvers as $approver)
                            <div class="approver-card">
                                <span class="approver-avatar">
                                    {{ strtoupper(substr($approver->first_name, 0, 1)) }}
                                </span>

                                <strong>
                                    {{ $approver->last_name }},
                                    {{ $approver->first_name }}
                                    {{ $approver->initial }}
                                </strong>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No approvers selected.</p>
                        @endforelse
                    </div>
                </div>

                <div class="card sip-card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold">
                            <i class="fa fa-info-circle text-info"></i> Summary
                        </h5>
                    </div>

                    <div class="card-body">
                        <p class="mb-2"><strong>Budget:</strong></p>
                        <h5 class="text-primary font-weight-bold">{{ $sip->budget_allocation ?? 'N/A' }}</h5>

                        <hr>

                        <p class="mb-2"><strong>Current Status:</strong></p>
                        <span class="status-badge {{ $badgeClass }}">
                            {{ $sip->status ?? 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
