<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        @page {
            margin: 15px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        th {
            background: #d9d9d9;
            text-align: center;
            font-weight: bold;
        }

        .left {
            text-align: left;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .header h2, .header h3, .header h4, .header p {
            margin: 0;
        }

        .total-row {
            background: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>

{{-- ================= HEADER ================= --}}
<div class="header">

    <p>Republic of the Philippines</p>
    <h3>DEPARTMENT OF EDUCATION</h3>
    <p>Region XI</p>
    <h4>DIVISION OF DAVAO DEL NORTE</h4>

    <h4>{{ strtoupper($sip->school_name ?? 'SCHOOL NAME') }}</h4>

    <br>

    <h3>PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)</h3>

    <p>Fiscal Year {{ date('Y') }}</p>
</div>

{{-- ================= TABLE ================= --}}
<table>

    <tr>
        <th>General Description</th>
        <th>Type</th>
        <th>Quantity / Size</th>
        <th>Mode of Procurement</th>
        <th>Start</th>
        <th>End</th>
        <th>Source</th>
        <th>Budget</th>
        <th>Documents</th>
        <th>Remarks</th>
    </tr>

    {{-- INIT GRAND TOTAL --}}
    @php
        $grandTotal = 0;
    @endphp

    {{-- ================= DATA ================= --}}
    @foreach ($report as $group)
        @foreach ($group['items'] as $item)

            @php
                $grandTotal += (float) $item->amount;
            @endphp

            <tr>

                <td class="left">
                    {{ $group['component']->project_description }}
                </td>

                <td>Goods</td>

                <td>
                    {{ $item->quantity_size }} {{ $item->item_name }}
                </td>

                <td>
                    {{ $group['component']->mode_of_procurement }}
                </td>

                <td>
                    {{ $group['component']->start_date }}
                </td>

                <td>
                    {{ $group['component']->end_date }}
                </td>

                <td>
                    {{ $group['component']->source_of_fund }}
                </td>

                <td>
                    {{ number_format($item->amount, 2) }}
                </td>

                <td>
                    {{ $item->supporting_documents_description ?? '-' }}
                </td>

                <td>
                    {{ $group['component']->remarks }}
                </td>

            </tr>

        @endforeach
    @endforeach

    {{-- ================= GRAND TOTAL ================= --}}
    <tr class="total-row">

        <td colspan="7" class="left">
            GRAND TOTAL
        </td>

        <td>
            {{ number_format($grandTotal, 2) }}
        </td>

        <td></td>
        <td></td>

    </tr>

</table>

<br><br><br>

{{-- ================= SIGNATORIES ================= --}}
<table style="width:100%; border:none;">

    <tr>

        <td style="border:none; text-align:center; width:33%;">
            Prepared by:<br><br><br>
            _______________________
        </td>

        <td style="border:none; text-align:center; width:33%;">
            Reviewed by:<br><br><br>
            _______________________
        </td>

        <td style="border:none; text-align:center; width:33%;">
            Approved by:<br><br><br>
            _______________________
        </td>

    </tr>

</table>

</body>
</html>
