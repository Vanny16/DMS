@extends('templates.backend.layouts.main')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Manage SIP</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SIP Details</h3>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('sip.update', $sip->sip_id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Current SIP File</label><br>

                        @if($sip->file_name)
                            <a href="{{ asset('uploads/sip/' . $sip->file_name) }}" target="_blank" class="btn btn-info btn-sm">
                                View Uploaded File
                            </a>
                        @else
                            <span class="text-muted">No file uploaded</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Update SIP File</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Budget Allocation</label>
                        <input type="text" name="budget_allocation" class="form-control"
                               value="{{ $sip->budget_allocation }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" value="{{ $sip->status }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Update SIP
                    </button>

                    <a href="{{ route('sip.main') }}" class="btn btn-secondary">
                        Back
                    </a>

                </form>

            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Approvers</h3>
            </div>

            <div class="card-body">
                <ul>
                    @foreach($approvers as $approver)
                        <li>
                            {{ $approver->last_name }},
                            {{ $approver->first_name }}
                            {{ $approver->initial }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Manage Annual Improvement Plan</h3>
            </div>

            <div class="card-body">

                {{-- <form method="POST" action="{{ route('sip.aip.update', $sip->sip_id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Current Annual Improvement Plan File</label><br>

                        @if($sip->aip_file)
                            <a href="{{ asset('uploads/aip/' . $sip->aip_file) }}" target="_blank" class="btn btn-info btn-sm">
                                View AIP File
                            </a>
                        @else
                            <span class="text-muted">No AIP file uploaded</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Upload / Update Annual Improvement Plan</label>
                        <input type="file" name="aip_file" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save Annual Improvement Plan
                    </button>
                </form> --}}

            </div>
        </div>

    </div>
</section>

@endsection
