@extends('templates.backend.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SIP List</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#createSipModal">
                            <i class="fa fa-plus"></i> Create SIP
                        </button>
                    </div>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sip_list as $sip)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sip->file_name ?? 'N/A' }}</td>
                                    <td>{{ $sip->budget_allocation ?? 'N/A' }}</td>
                                    <td>{{ $sip->status ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="createSipModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form method="POST" action="{{ route('sip.save') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title">Create SIP</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">

                                        {{-- File Upload --}}
                                        <div class="form-group">
                                            <label>Upload File</label>
                                            <input type="file" name="file" class="form-control" required>
                                        </div>

                                        {{-- Budget Allocation --}}
                                        <div class="form-group">
                                            <label>Budget Allocation</label>
                                            <input type="text" name="budget_allocation" class="form-control" required>
                                        </div>

                                        {{-- Multiple Approvers --}}
                                        <div class="form-group">
                                            <label>Select Approvers</label>
                                            <select name="approver_ids[]" class="form-control approver-select" multiple
                                                required>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->user_id }}">
                                                        {{ $user->last_name }}, {{ $user->first_name }} {{ $user->initial }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Hold CTRL to select multiple</small>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
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
