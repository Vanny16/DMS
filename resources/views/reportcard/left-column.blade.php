@php $isReadonly = isset($readonly) && $readonly; @endphp

<div class="col-md-6 border-box">
    <div class="col-md-12 border-box">
        <h5 class="text-center mb-3 text-bold">REPORT ON ATTENDANCE</h5>
       @php
    $months = ['Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr'];
@endphp

    <h6 class="fw-bold mb-3">REPORT ON ATTENDANCE</h6>
        <div class="table-responsive mb-4">
            <table class="table table-bordered attendance-table text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-start"></th>
                        @foreach($months as $month)
                            <th>{{ $month }}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- School Days Row --}}
                    <tr>
                        <td class="text-start">No. of School Days</td>
                        @foreach($months as $label)
                            <td>{{ $schoolDays[$label] ?? 0 }}</td>
                        @endforeach
                        <td class="fw-semibold">{{ array_sum($schoolDays) }}</td>
                    </tr>

                    {{-- Present Days Row --}}
                    <tr>
                        <td class="text-start">No. of Days Present</td>
                        @foreach($months as $label)
                            <td>{{ $attendance[$label] ?? 0 }}</td>
                        @endforeach
                        <td class="fw-semibold">{{ array_sum($attendance) }}</td>
                    </tr>

                    {{-- Absent Days Row --}}
                    <tr>
                        <td class="text-start">No. of Days Absent</td>
                        @foreach($months as $label)
                            <td>{{ max(0, ($schoolDays[$label] ?? 0) - ($attendance[$label] ?? 0)) }}</td>
                        @endforeach
                        <td class="fw-semibold">{{ max(0, array_sum($schoolDays) - array_sum($attendance)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <p class="mt-4 text-center"><strong>PARENT/GUARDIAN’S SIGNATURE</strong></p>

    @foreach(['1st','2nd','3rd','4th'] as $q)
        <div class="form-group row align-items-center">
            <label class="col-auto col-form-label font-weight-bold">{{ $q }} Quarter:</label>
            <div class="col">
                <input type="text" name="quarter_{{ strtolower($q[0]) }}_signature"
                    class="d-inline-block text-center font-weight-bold"
                    style="width: 100%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                    {{ $isReadonly ? 'readonly' : '' }}>
            </div>
        </div>
    @endforeach
    <p class="section-title mt-4 text-center"><strong>Certificate of Transfer</strong></p>

    <div class="form-group row align-items-center">
        <label class="col-auto col-form-label font-weight-bold">Admitted to Grade:</label>
        <div class="col">
            <input type="text" name="admitted_grade" class="d-inline-block text-center font-weight-bold"
                style="width: 100%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
        </div>
        <label class="col-auto col-form-label font-weight-bold">Section:</label>
        <div class="col">
            <input type="text" name="admitted_section" class="d-inline-block text-center font-weight-bold"
                style="width: 100%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
        </div>
    </div>
    <div class="form-group row align-items-center">
        <label class="col-auto col-form-label font-weight-bold">Eligibility for Admission to Grade:</label>
        <div class="col">
            <input type="text" name="eligibility_grade" class="d-inline-block text-center font-weight-bold"
                style="width: 100%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
        </div>
    </div>

    <p>Approved:</p>
    <div class="row">
        <div class="col text-center font-italic">
            <input type="text" name="approved_school_head" class="d-inline-block text-center text-bold"
                style="width: 200px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
            <br>
            <small>School Head</small>
        </div>
        <div class="col text-center font-italic">
            <input type="text" name="approved_adviser" class="d-inline-block text-center text-bold"
                style="width: 200px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
            <br>
            <small>Adviser</small>
        </div>
    </div>

    <p class="section-title mt-4 text-center"><strong>Cancellation of Eligibility to Transfer</strong></p>
    <p>
        Admitted in:
        <input type="text" name="cancellation_admitted_in" class="d-inline-block text-bold"
            style="width: 75%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
    </p>

    <div class="row font-italic">
        <div class="col text-left">
            Date:
            <input type="text" name="cancellation_date" class="d-inline-block text-bold"
                style="width: 150px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
        </div>
        <div class="col text-center">
            <input type="text" name="school_head_signature" class="d-inline-block text-bold"
                style="width: 200px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
            <br>
            <small>School Head</small>
        </div>
    </div>
</div>

<script>
    function calculateAttendanceTotals() {
        const sumColumn = (selector, totalSelector) => {
            let total = 0;
            document.querySelectorAll(selector).forEach(cell => {
                let val = parseInt(cell.innerText.trim());
                if (!isNaN(val)) total += val;
            });
            const totalCell = document.querySelector(totalSelector);
            if (totalCell) totalCell.innerText = total;
        };

        sumColumn('.school-days', '.school-days-total');
        sumColumn('.days-present', '.days-present-total');
        sumColumn('.days-absent', '.days-absent-total');
    }

    window.addEventListener('beforeprint', calculateAttendanceTotals);
</script>
