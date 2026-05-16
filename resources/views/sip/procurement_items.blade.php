@extends('templates.backend.layouts.main')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <h2 class="font-weight-bold mb-4">Procurement Item Info</h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="font-weight-bold mb-0">List of Items</h6>

                <button type="button" class="btn btn-primary btn-modern" data-toggle="modal" data-target="#createItemModal">
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
                                    <td class="text-center">{{ number_format($item->amount, 2) }}</td>
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

   <div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-labelledby="createItemModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <form method="POST"
              enctype="multipart/form-data"
              action="{{ route('sip.procurement.items.store', $procurement->procurement_component_id) }}">

            @csrf

            <div class="modal-content" style="border-radius: 18px;">

                <div class="modal-header border-0">
                    <h5 class="modal-title font-weight-bold">
                        Create PPMP Item
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- ITEM NAME --}}
                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" class="form-control" required>
                    </div>

                    {{-- TYPE OF PROJECT --}}
                    <div class="form-group">
                        <label>Type of Project</label>
                        <input type="text" name="type_of_project" class="form-control">
                    </div>

                    {{-- MODE OF PROCUREMENT --}}
                    <div class="form-group">
                        <label>Mode of Procurement</label>
                        <input type="text" name="mode_of_procurement" class="form-control" required>
                    </div>

                    <div class="form-row">

                        {{-- QUANTITY --}}
                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="1" required>
                        </div>

                        {{-- UNIT --}}
                        <div class="form-group col-md-6">
                            <label>Unit of Measure</label>
                            <input type="text" name="unit_of_measure" class="form-control" placeholder="pcs, box, set..." required>
                        </div>

                    </div>

                    {{-- AMOUNT --}}
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-row">

                        {{-- YEAR --}}
                        <div class="form-group col-md-6">
                            <label>Year</label>
                            <select name="year" class="form-control" required>
                                <option value="">Select Year</option>
                                @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        {{-- DELIVERY PERIOD --}}
                        <div class="form-group col-md-6">
                            <label>Expected Delivery Period</label>
                            <input type="text" name="delivery_period" class="form-control" placeholder="e.g. 2 weeks, 1 month">
                        </div>

                    </div>

                    {{-- IMPLEMENTATION PERIOD --}}
                    <div class="form-group">
                        <label>Implementation Period</label>
                        <input type="text" name="implementation_period" class="form-control" placeholder="e.g. Jan - March 2026">
                    </div>

                    {{-- MONTH DROPDOWN (SINGLE SELECT) --}}
                    <div class="form-group">
                        <label>Month</label>
                        <select name="month" class="form-control" required>
                            <option value="">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                    {{-- SUPPORTING DOCS --}}
                    <div class="form-group">
                        <label>Supporting Documents</label>
                        <input type="file" name="supporting_documents" class="form-control">
                    </div>

                    {{-- SUPPORTING DOC DESCRIPTION --}}
                    <div class="form-group">
                        <label>Supporting Document Description</label>
                        <textarea name="supporting_documents_description" class="form-control" rows="2"></textarea>
                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="submit" class="btn btn-dark">
                        <i class="fa fa-save"></i> Save
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

    <script>
        document.getElementById('months').addEventListener('change', function() {
            let selectedMonths = Array.from(this.selectedOptions).map(option => option.value);
            let container = document.getElementById('monthQuantityContainer');

            container.innerHTML = '';

            selectedMonths.forEach(function(month) {
                let row = document.createElement('div');
                row.classList.add('d-flex', 'align-items-center', 'mb-2');

                row.innerHTML = `
                <label class="mb-0 mr-2" style="width: 100px;">${month}:</label>
                <input type="number"
                       name="quantities[${month}]"
                       class="form-control"
                       style="width: 100px;"
                       min="1"
                       required>
            `;

                container.appendChild(row);
            });
        });
    </script>
@endsection
