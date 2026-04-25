@extends('templates.backend.layouts.main')

@push('scripts')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush

@section('content')

@php $typ_id = session('typ_id'); @endphp

<style>
    @page { size: A4 landscape; margin: 0; }
    html, body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        background: white;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .print-wrapper { margin: 0; padding: 0; background-color: white; overflow: visible; }
    .container-report {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        gap: 4px;
        width: 100%;
    }
    .column { width: 49.5%; overflow: visible; }
    h5, h4 { text-align: center; margin: 2px 0; font-size: 12px; }
    .section-title {
        font-weight: bold;
        background-color: white;
        padding: 2px;
        margin-top: 3px;
        font-size: 12px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
        border-color: black;
        background-color: white;
    }
    th, td {
        border: 1px solid black;
        padding: 1px 2px;
        text-align: left;
        vertical-align: top;
        background-color: white;
    }
    input[type="text"], select {
        width: 100%;
        border: none;
        padding: 0 1px;
        font-size: 11px;
        text-align: center;
        height: 16px;
        background-color: transparent;
    }
    .text-center { text-align: center; }
    .align-middle { vertical-align: middle; }

    @media screen and (max-width: 768px) {
        .form-row { flex-direction: column; }
        .form-row .col-md-2,
        .form-row .col-md-6 { width: 100% !important; }
        .container-report { flex-direction: column; }
        .column { width: 100% !important; }
    }

    @media print {
        html, body { width: 297mm; height: 210mm; overflow: hidden !important; }
        .d-print-none { display: none !important; }
        .container-report, .column { overflow: visible !important; }
        select { display: none !important; }
        .select-print-value { display: inline-block !important; }
    }

    .select-print-value { display: none; }
</style>

<div class="print-wrapper">
    <form method="POST" action="{{ route('report.print', ['id' => $user['usrID'] ?? 0]) }}">
        @csrf
        <input type="hidden" name="age" value="{{ $age ?? '' }}">
        <input type="hidden" name="sex" value="{{ $sex ?? '' }}">

        <div class="container-report" data-aos="fade-up" data-aos-delay="150">
            @include('reportcard.left-column', [
                'readonly' => $typ_id == 4,
                'months' => ['Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr'],
                'schoolDays' => $schoolDays ?? array_fill_keys(['Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr'], 0),
                'attendance' => $attendance ?? array_fill_keys(['Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar','Apr'], 0)
            ])

            @include('reportcard.right-column', [
                'readonly' => $typ_id == 4,
                'user' => $user ?? [],
                'age' => $age ?? '',
                'sex' => $sex ?? ''
            ])
        </div>
    </form>
</div>

@if(in_array($typ_id, [1, 2, 3]) && isset($user['usrID']))
    <div class="container d-print-none mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6 col-12 mb-3">
                <a href="{{ route('report.showForm') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left me-1"></i> Back to Report
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-12 mb-3">
                <button onclick="window.print();" class="btn btn-primary btn-print w-100">
                    <i class="fas fa-print me-1"></i> Print Report Card
                </button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({ duration: 800, once: true });

        document.querySelectorAll('tbody tr').forEach(row => {
            const cells = row.querySelectorAll('td[contenteditable="true"]');
            const editableCells = Array.from(cells).slice(0, 11);
            const totalCell = cells[11];

            function updateTotal() {
                let total = 0;
                editableCells.forEach(cell => {
                    let val = parseInt(cell.textContent.trim(), 10);
                    if (!isNaN(val)) total += val;
                });
                totalCell.textContent = total;
            }

            editableCells.forEach(cell => {
                cell.addEventListener('input', function () {
                    let value = this.textContent.replace(/\D/g, '');
                    if (value) {
                        let num = Math.min(32, Math.max(1, parseInt(value)));
                        this.textContent = num;
                    } else {
                        this.textContent = '';
                    }
                    updateTotal();
                });
            });
        });

        // ✅ Auto-print on load
        setTimeout(() => window.print(), 500);
    });
</script>

@endsection

@push('scripts')
<script>
    window.onload = function () {
        window.print();

        window.onafterprint = function () {
            if (window.opener) {
                window.close();
            } else {
                window.location.href = "{{ route('report.showForm') }}";
            }
        };
    };
</script>
@endpush
