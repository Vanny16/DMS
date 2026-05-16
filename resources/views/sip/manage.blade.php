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
                            <div class="d-flex align-items-center justify-content-between w-100">

                                <h5 class="mb-0 font-weight-bold">
                                    <i class="fa fa-file-text-o text-primary"></i> SIP Details
                                </h5>

                                <span class="status-badge {{ $badgeClass }} px-3 py-2 ml-auto">
                                    {{ $sip->status ?? 'N/A' }}
                                </span>

                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('sip.update', $sip->sip_id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Current SIP File</label>

                                    <div class="file-preview-box">
                                        @if ($sip->file_name)
                                            <div class="file-item">
                                                <div class="file-icon">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </div>

                                                <div>
                                                    <strong>{{ $sip->file_name }}</strong><br>
                                                    <a href="{{ asset('uploads/sip/' . $sip->file_name) }}" target="_blank"
                                                        class="btn btn-info btn-sm btn-modern mt-2">
                                                        <i class="fa fa-eye"></i> View Uploaded File
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">No file uploaded</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>Update SIP File</label>
                                        <input type="file" name="file" class="form-control">
                                        <small class="text-muted">Optional</small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Budget Allocation</label>
                                        <input type="text" name="budget_allocation" class="form-control"
                                            value="{{ $sip->budget_allocation }}" required>
                                    </div>

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
                                <p class="text-muted mb-3">Upload or update the Annual Improvement Plan related to this SIP.
                                </p>

                                {{-- Uncomment when your route/controller is ready --}}

                                <form method="POST" action="{{ route('sip.aip.update', $sip->sip_id) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label>Current Annual Improvement Plan File</label><br>

                                        @if ($aip->file_name)
                                            <a href="{{ asset('uploads/aip/' . $aip->file_name) }}" target="_blank"
                                                class="btn btn-info btn-sm btn-modern">
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


                            </div>
                        </div>
                    </div>

                    <div class="card sip-card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0 font-weight-bold">
                                <i class="fa fa-shopping-cart text-warning"></i> Manage Procurements
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="file-preview-box">
                                <p class="mb-2 font-weight-bold">Procurement Documents</p>
                                <p class="text-muted mb-3">
                                    Generate APP, PPMP, and WFP documents related to this SIP.
                                </p>

                                <button type="button" class="btn btn-success btn-modern" data-toggle="modal"
                                    data-target="#createProcurementModal">
                                    <i class="fa fa-plus"></i> Create Procurement
                                </button>

                                <a href="{{ route('sip.procurement.generate.app', $sip->sip_id) }}" target="_blank"
                                    class="btn btn-outline-primary btn-modern mb-2">
                                    <i class="fa fa-file-pdf-o"></i> Generate APP
                                </a>

                                <a href="{{ route('sip.procurement.list', $sip->sip_id) }}"
                                    class="btn btn-info btn-modern">
                                    <i class="fa fa-list"></i> Procurement List
                                </a>
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
                                <div class="approver-card d-flex align-items-center mb-2">

                                    <span class="approver-avatar me-2">
                                        {{ strtoupper(substr($approver->first_name, 0, 1)) }}
                                    </span>

                                    <div>
                                        <strong>
                                            {{ $approver->last_name }},
                                            {{ $approver->first_name }}
                                            {{ $approver->initial }}
                                        </strong>

                                        <div class="text-muted" style="font-size: 12px;">
                                            {{ $approver->position }}
                                        </div>
                                    </div>

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

                            {{-- TOTAL BUDGET --}}
                            <div class="mb-3">
                                <p class="mb-1 text-muted">
                                    <strong>Total Budget Allocation</strong>
                                </p>

                                <h4 class="text-primary font-weight-bold mb-0">
                                    ₱{{ number_format($budgetAllocation, 2) }}
                                </h4>
                            </div>

                            <hr>

                            {{-- USED BUDGET --}}
                            <div class="mb-3">
                                <p class="mb-1 text-muted">
                                    <strong>Used Procurement Budget</strong>
                                </p>

                                <h5 class="text-danger font-weight-bold mb-0">
                                    ₱{{ number_format($usedBudget, 2) }}
                                </h5>
                            </div>

                            <hr>

                            {{-- REMAINING --}}
                            <div class="mb-3">
                                <p class="mb-1 text-muted">
                                    <strong>Remaining Budget</strong>
                                </p>

                                <h4 class="text-success font-weight-bold mb-0">
                                    ₱{{ number_format($remainingBudget, 2) }}
                                </h4>
                            </div>

                            <hr>

                            {{-- UTILIZATION --}}
                            @php
                                $utilization = $budgetAllocation > 0 ? ($usedBudget / $budgetAllocation) * 100 : 0;

                                $utilization = min($utilization, 100);
                            @endphp

                            <p class="mb-2">
                                <strong>Budget Utilization</strong>
                            </p>

                            <div class="progress mb-3" style="height: 18px; border-radius: 20px;">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: {{ $utilization }}%; border-radius:20px;">

                                    {{ number_format($utilization, 0) }}%
                                </div>
                            </div>

                            <hr>

                            {{-- STATUS --}}
                            <p class="mb-2">
                                <strong>Current Status</strong>
                            </p>

                            <span class="status-badge {{ $badgeClass }}">
                                {{ $sip->status ?? 'N/A' }}
                            </span>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>



    {{-- <div class="modal fade" id="createProcurementModal" tabindex="-1" role="dialog"
        aria-labelledby="createProcurementModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('sip.procurement.store', $sip->sip_id) }}">
                @csrf

                <div class="modal-content" style="border-radius: 18px; overflow: hidden;">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title font-weight-bold" id="createProcurementModalLabel">
                            <i class="fa fa-plus-circle"></i> Create Procurement
                        </h5>

                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Code</label>
                            <select name="code_id" class="form-control" required>
                                <option value="">-- Select Code --</option>

                                @foreach ($codes as $code)
                                    <option value="{{ $code->code_id }}">
                                        @if (isset($code->sub_category))
                                            {{ $code->code }} - {{ $code->sub_category }}
                                        @else
                                            {{ $code->code }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Enter procurement description..."
                                required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-success btn-modern">
                            <i class="fa fa-save"></i> Save Procurement
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}


    <div class="modal fade"
    id="createProcurementModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="createProcurementModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl" role="document">

        <form method="POST"
            action="{{ route('sip.procurement.store', $sip->sip_id) }}">

            @csrf

            <div class="modal-content"
                style="border-radius:18px; overflow:hidden;">

                {{-- HEADER --}}
                <div class="modal-header bg-success text-white">

                    <h5 class="modal-title font-weight-bold"
                        id="createProcurementModalLabel">

                        <i class="fa fa-plus-circle"></i>
                        Create Procurement
                    </h5>

                    <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                        <span>&times;</span>
                    </button>

                </div>

                {{-- BODY --}}
                <div class="modal-body">

                    <div class="row">

                        {{-- CODE --}}
                        <div class="col-md-4">
                            <div class="form-group">

                                <label>
                                    Code
                                </label>

                                <select name="code_id"
                                    class="form-control"
                                    required>

                                    <option value="">
                                        -- Select Code --
                                    </option>

                                    @foreach ($codes as $code)

                                        <option value="{{ $code->code_id }}">

                                            @if (isset($code->sub_category))
                                                {{ $code->code }}
                                                -
                                                {{ $code->sub_category }}
                                            @else
                                                {{ $code->code }}
                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>

                        {{-- PROJECT TITLE --}}
                        <div class="col-md-8">
                            <div class="form-group">

                                <label>
                                    Project Title
                                </label>

                                <textarea
                                    name="project_title"
                                    class="form-control"
                                    rows="2"
                                    required></textarea>

                            </div>
                        </div>

                        {{-- END USER --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>
                                    End User / Implementing Unit
                                </label>

                                <input type="text"
                                    name="end_user_unit"
                                    class="form-control">

                            </div>
                        </div>

                        {{-- MODE --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>
                                    Mode of Procurement
                                </label>

                                <input type="text"
                                    name="mode_of_procurement"
                                    class="form-control">

                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>
                                    General Description of the Project
                                </label>

                                <textarea
                                    name="project_description"
                                    class="form-control"
                                    rows="3"></textarea>

                            </div>
                        </div>

                        {{-- EARLY PROCUREMENT --}}
                        <div class="col-md-4">
                            <div class="form-group">

                                <label>
                                    Early Procurement Activity?
                                </label>

                                <select name="early_procurement"
                                    class="form-control">

                                    <option value="No">
                                        No
                                    </option>

                                    <option value="Yes">
                                        Yes
                                    </option>

                                </select>

                            </div>
                        </div>

                        {{-- EPA DETAILS --}}
                        <div class="col-md-8">
                            <div class="form-group">

                                <label>
                                    Early Procurement Details
                                </label>

                                <input type="text"
                                    name="early_procurement_details"
                                    class="form-control">

                            </div>
                        </div>

                      {{-- START MONTH --}}
<div class="col-md-6">
    <div class="form-group">

        <label>
            Start of Procurement Activity
        </label>

        <input type="month"
            name="start_date"
            class="form-control">

    </div>
</div>

{{-- END MONTH --}}
<div class="col-md-6">
    <div class="form-group">

        <label>
            End of Procurement Activity
        </label>

        <input type="month"
            name="end_date"
            class="form-control">

    </div>
</div>

                        {{-- SOURCE OF FUND --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>
                                    Source of Fund
                                </label>

                                <input type="text"
                                    name="source_of_fund"
                                    class="form-control">

                            </div>
                        </div>

                        {{-- BUDGET --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>
                                    Approved Budget
                                </label>

                                <input type="number"
                                    step="0.01"
                                    name="approved_budget"
                                    class="form-control">

                            </div>
                        </div>

                        {{-- STRATEGY --}}
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>
                                    Procurement Strategy / Tools
                                </label>

                                <textarea
                                    name="procurement_strategy"
                                    class="form-control"
                                    rows="2"></textarea>

                            </div>
                        </div>

                        {{-- REMARKS --}}
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>
                                    Remarks
                                </label>

                                <textarea
                                    name="remarks"
                                    class="form-control"
                                    rows="2"></textarea>

                            </div>
                        </div>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary btn-modern"
                        data-dismiss="modal">

                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-success btn-modern">

                        <i class="fa fa-save"></i>
                        Save Procurement

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


@endsection
