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

                    <a href="{{ route('sip.manage', $sip->sip_id) }}" class="btn btn-light btn-modern mt-3 mt-md-0">
                        <i class="fa fa-arrow-left"></i> Back to Manage SIP
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
                        {{-- <thead class="text-center">
                            <tr>
                                <th width="5%">#</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Total</th>

                                <th>Date Created</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead> --}}

                        <thead class="text-center">

                            <tr>

                                <th width="4%">
                                    #
                                </th>

                                <th width="6%">
                                    Code
                                </th>

                                <th width="15%">
                                    Project Title
                                </th>

                                <th width="10%">
                                    End User /
                                    Implementing Unit
                                </th>

                                <th width="12%">
                                    Project Description
                                </th>

                                <th width="8%">
                                    Mode of Procurement
                                </th>

                                <th width="5%">
                                    EPA
                                </th>

                                <th width="8%">
                                    Start Date
                                </th>

                                <th width="8%">
                                    End Date
                                </th>

                                <th width="8%">
                                    Source of Fund
                                </th>

                                <th width="8%">
                                    Budget
                                </th>

                                <th width="10%">
                                    Procurement Strategy
                                </th>

                                <th width="8%">
                                    Remarks
                                </th>

                                <th width="10%">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        {{-- <tbody>
                            @forelse($procurements as $index => $procurement)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $procurement->code }}</td>
                                    <td>{{ $procurement->description }}</td>
                                    <td class="text-center">
                                        {{ number_format($procurement->total_amount, 2) }}
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($procurement->created_at)->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('sip.procurement.items', $procurement->procurement_id) }}"
                                            class="btn btn-success btn-sm btn-modern">
                                            <i class="fa fa-plus"></i> Create Item
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fa fa-folder-open fa-2x mb-2"></i>
                                        <br>
                                        No procurements created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody> --}}

                        <tbody>
                            @forelse($procurements as $index => $procurement)
                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- CATEGORY / CODE --}}
                                    <td>
                                        {{ $procurement->code }}
                                    </td>

                                    {{-- PROJECT TITLE --}}
                                    <td>
                                        <strong>
                                            {{ $procurement->project_title }}
                                        </strong>

                                        @if ($procurement->project_description)
                                            <br>
                                            <small class="text-muted">
                                                {{ $procurement->project_description }}
                                            </small>
                                        @endif
                                    </td>

                                    {{-- END USER --}}
                                    <td>
                                        {{ $procurement->end_user_unit }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $procurement->project_description }}
                                        </strong>


                                    </td>

                                    {{-- MODE --}}
                                    <td>
                                        {{ $procurement->mode_of_procurement }}
                                    </td>

                                    {{-- EARLY PROCUREMENT --}}
                                    <td class="text-center">
                                        {{ $procurement->early_procurement }}
                                    </td>

                                    {{-- START DATE --}}
                                    <td>
                                        @if ($procurement->start_date)
                                            {{ \Carbon\Carbon::parse($procurement->start_date)->format('M d, Y') }}
                                        @endif
                                    </td>

                                    {{-- END DATE --}}
                                    <td>
                                        @if ($procurement->end_date)
                                            {{ \Carbon\Carbon::parse($procurement->end_date)->format('M d, Y') }}
                                        @endif
                                    </td>

                                    {{-- SOURCE OF FUND --}}
                                    <td>
                                        {{ $procurement->source_of_fund }}
                                    </td>

                                    {{-- BUDGET --}}
                                    <td class="text-right">
                                        {{ number_format($procurement->approved_budget, 2) }}
                                    </td>

                                    {{-- PROCUREMENT STRATEGY --}}
                                    <td>
                                        {{ $procurement->procurement_strategy }}
                                    </td>

                                    {{-- REMARKS --}}
                                    <td>
                                        {{ $procurement->remarks }}
                                    </td>

                                    {{-- ACTION --}}
                                    <td>
                                        <a href="{{ route('sip.procurement.items', $procurement->procurement_id) }}"
                                            class="btn btn-success btn-sm btn-modern">

                                            <i class="fa fa-plus"></i>
                                            Create Item
                                        </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="13" class="text-center text-muted py-4">

                                        <i class="fa fa-folder-open fa-2x mb-2"></i>

                                        <br>

                                        No procurements created yet.

                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
