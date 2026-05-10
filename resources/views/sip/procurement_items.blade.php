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
            <form method="POST" action="{{ route('sip.procurement.items.store', $procurement->procurement_component_id) }}">
            @csrf

            <div class="modal-content" style="border-radius: 18px;">
                <div class="modal-header border-0">
                    <h5 class="modal-title font-weight-bold" id="createItemModalLabel">
                        Create Item
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Mode of Procurement</label>
                        <input type="text" name="mode_of_procurement" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Measure</label>
                            <select name="unit_of_measure" class="form-control" required>
                                <option value="">Select Unit</option>
                                <option value="pcs">pcs</option>
                                <option value="box">box</option>
                                <option value="ream">ream</option>
                                <option value="set">set</option>
                                <option value="unit">unit</option>
                                <option value="lot">lot</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Year</label>
                            <select name="year" class="form-control" required>
                                <option value="">Select Year</option>
                                @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Select Month(s)</label>
                        <select name="months[]" id="months" class="form-control" multiple required
                            style="height: 120px;">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Enter Quantity for Selected Month(s)</label>
                        <div id="monthQuantityContainer"></div>
                    </div>

                </div>

                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-dark btn-modern">
                        <i class="fa fa-save"></i> Save
                    </button>

                    <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">
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
