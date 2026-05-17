@extends('templates.backend.layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="sip-page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="mb-1 font-weight-bold">Procurement List</h2>
                    <p class="mb-0">List of created procurements for this SIP.</p>
                </div>

                <a href="{{ route('sip.manage', $sip->sip_id) }}" class="btn btn-light btn-modern">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

<section class="content">
<div class="container-fluid">

<div class="card sip-card">
<div class="card-header">
    <h5 class="mb-0 font-weight-bold">
        <i class="fa fa-list text-info"></i> Created Procurements
    </h5>
</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead class="text-center">
<tr>
    <th>#</th>
    <th>Code</th>
    <th>Project Title</th>
    <th>End User</th>
    <th>Description</th>
    <th>Mode</th>
    <th>EPA</th>
    <th>Start</th>
    <th>End</th>
    <th>Fund</th>
    <th>Budget</th>
    <th>Strategy</th>
    <th>Remarks</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@forelse($procurements as $index => $procurement)
<tr>

<td>{{ $index + 1 }}</td>
<td>{{ $procurement->code }}</td>

<td>
    <strong>{{ $procurement->description }}</strong>
</td>

<td>{{ $procurement->end_user_unit }}</td>

<td>{{ $procurement->project_description }}</td>

<td>{{ $procurement->mode_of_procurement }}</td>

<td>{{ $procurement->early_procurement }}</td>

<td>{{ $procurement->start_date }}</td>

<td>{{ $procurement->end_date }}</td>

<td>{{ $procurement->source_of_fund }}</td>

<td class="text-right">{{ number_format($procurement->approved_budget,2) }}</td>

<td>{{ $procurement->procurement_strategy }}</td>

<td>{{ $procurement->remarks }}</td>

<td>

{{-- EDIT BUTTON --}}
<button class="btn btn-primary btn-sm btn-edit-procurement"
    data-toggle="modal"
    data-target="#editProcurementModal"

    {{-- data-url="{{ route('sip.procurement.update', $procurement->procurement_id) }}" --}}

    data-code="{{ $procurement->code_id }}"
    data-title="{{ $procurement->description }}"
    data-enduser="{{ $procurement->end_user_unit }}"
    data-mode="{{ $procurement->mode_of_procurement }}"
    data-description="{{ $procurement->project_description }}"
    data-early="{{ $procurement->early_procurement }}"
    data-start="{{ $procurement->start_date }}"
    data-end="{{ $procurement->end_date }}"
    data-source="{{ $procurement->source_of_fund }}"
    data-budget="{{ $procurement->approved_budget }}"
    data-strategy="{{ $procurement->procurement_strategy }}"
    data-remarks="{{ $procurement->remarks }}"
>
<i class="fa fa-edit"></i>
</button>

<a href="{{ route('sip.procurement.items', $procurement->procurement_id) }}"
        class="btn btn-success btn-sm btn-modern">

        <i class="fa fa-plus"></i>
        Create Item
    </a>

</td>

</tr>
@empty
<tr>
<td colspan="14" class="text-center text-muted">
No procurements found
</td>
</tr>
@endforelse

</tbody>
</table>

</div>
</div>

</div>
</section>

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editProcurementModal" tabindex="-1">

<div class="modal-dialog modal-xl">

<form method="POST" id="editProcurementForm">
@csrf
@method('PUT')

<div class="modal-content">

<div class="modal-header bg-primary text-white">
<h5>Edit Procurement</h5>
<button class="close text-white" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">

<div class="row">

<div class="col-md-4">
<label>Code</label>
<select id="edit_code_id" name="code_id" class="form-control">
@foreach($codes as $code)
<option value="{{ $code->code_id }}">{{ $code->code }}</option>
@endforeach
</select>
</div>

<div class="col-md-8">
<label>Project Title</label>
<textarea id="edit_project_title" name="project_title" class="form-control"></textarea>
</div>

<div class="col-md-6">
<label>End User</label>
<input type="text" id="edit_end_user_unit" name="end_user_unit" class="form-control">
</div>

<div class="col-md-6">
<label>Mode</label>
<input type="text" id="edit_mode" name="mode_of_procurement" class="form-control">
</div>

<div class="col-md-12">
<label>Description</label>
<textarea id="edit_description" name="project_description" class="form-control"></textarea>
</div>

<div class="col-md-4">
<label>EPA</label>
<select id="edit_early" name="early_procurement" class="form-control">
<option value="No">No</option>
<option value="Yes">Yes</option>
</select>
</div>

<div class="col-md-4">
<label>Start</label>
<input type="date" id="edit_start" name="start_date" class="form-control">
</div>

<div class="col-md-4">
<label>End</label>
<input type="date" id="edit_end" name="end_date" class="form-control">
</div>

<div class="col-md-6">
<label>Fund</label>
<input type="text" id="edit_source" name="source_of_fund" class="form-control">
</div>

<div class="col-md-6">
<label>Budget</label>
<input type="number" id="edit_budget" name="approved_budget" class="form-control">
</div>

<div class="col-md-12">
<label>Strategy</label>
<textarea id="edit_strategy" name="procurement_strategy" class="form-control"></textarea>
</div>

<div class="col-md-12">
<label>Remarks</label>
<textarea id="edit_remarks" name="remarks" class="form-control"></textarea>
</div>

</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button class="btn btn-success">Update</button>
</div>

</div>

</form>

</div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
$(document).on('click', '.btn-edit-procurement', function () {

    let btn = $(this);

    $('#editProcurementForm').attr('action', btn.data('url'));

    $('#edit_code_id').val(btn.data('code'));
    $('#edit_project_title').val(btn.data('title'));
    $('#edit_end_user_unit').val(btn.data('enduser'));
    $('#edit_mode').val(btn.data('mode'));
    $('#edit_description').val(btn.data('description'));
    $('#edit_early').val(btn.data('early'));
    $('#edit_start').val(btn.data('start'));
    $('#edit_end').val(btn.data('end'));
    $('#edit_source').val(btn.data('source'));
    $('#edit_budget').val(btn.data('budget'));
    $('#edit_strategy').val(btn.data('strategy'));
    $('#edit_remarks').val(btn.data('remarks'));
});
</script>

@endsection
