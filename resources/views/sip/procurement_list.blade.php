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
                        <thead class="text-center">
                            <tr>
                                <th width="5%">#</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Total</th>

                                <th>Date Created</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($procurements as $index => $procurement)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $procurement->code }}</td>
                                    <td>{{ $procurement->description }}</td>
                                    <td>--</td>

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
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
