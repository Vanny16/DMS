@extends('templates.backend.layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">

        <h2 class="font-weight-bold mb-4">Procurement Item Info</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="font-weight-bold mb-0">List of Items</h6>

            <button type="button" class="btn btn-primary btn-modern" data-toggle="modal"
                data-target="#createItemModal">
                <i class="fa fa-edit"></i> Create an Item
            </button>
        </div>

        <div class="card sip-card">
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Unit of Measure</th>
                            <th class="text-center">Total Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="text-center">{{ $item->item_name }}</td>
                                <td class="text-center">{{ $item->unit_of_measure }}</td>
                                <td class="text-center">{{ number_format($item->total_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No items created yet.
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
