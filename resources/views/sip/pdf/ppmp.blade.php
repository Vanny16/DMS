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

        th,
        td {
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

        .center {
            text-align: center;
        }

        .category {
            background: #ffe600;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .header h2,
        .header h3,
        .header h4,
        .header p {
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

        <h4>
            {{ strtoupper($sip->school_name ?? 'SCHOOL NAME') }}
        </h4>

        <br>

        <h3>
            PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)
        </h3>

        <p>
            Fiscal Year {{ date('Y') }}
        </p>

    </div>

    {{-- ================= TABLE ================= --}}
    <table>

        {{-- ================= TABLE HEADER ================= --}}
        <tr>

            <th width="18%">
                General Description and Objective of the Project to be Procured
            </th>

            <th width="10%">
                Type of Project
            </th>

            <th width="8%">
                Quantity / Size of Project
            </th>

            <th width="10%">
                Recommended Mode of Procurement
            </th>

            <th width="8%">
                Pre-Procurement Conference
            </th>

            <th width="8%">
                Start of Procurement Activity
            </th>

            <th width="8%">
                End of Procurement Activity
            </th>

            <th width="10%">
                Expected Delivery / Implementation Period
            </th>

            <th width="8%">
                Source of Fund
            </th>

            <th width="8%">
                Estimated Budget
            </th>

            <th width="8%">
                Attached Supporting Documents
            </th>

            <th width="8%">
                Remarks
            </th>

        </tr>

        @php
            $grandTotal = 0;

            $grouped = collect($report)->groupBy('code');
        @endphp
        @foreach ($report as $group)
            @foreach ($group['items'] as $item)
                <tr>

                    <td>{{ $group['component']->project_description }}</td>

                    <td>Goods</td>

                    <td>{{ $item->quantity_size }} {{ $item->item_name }}</td>

                    <td>{{ $group['component']->mode_of_procurement }}</td>

                    <td>{{ $group['component']->start_date }}</td>

                    <td>{{ $group['component']->end_date }}</td>
                    <td></td>

                    <td></td>

                    <td>{{ $group['component']->source_of_fund }}</td>

                    <td>{{ number_format($item->amount, 2) }}</td>
                    <td></td>

                    <td>{{ $group['component']->remarks }}</td>

                </tr>
            @endforeach
        @endforeach

        {{-- ================= GRAND TOTAL ================= --}}
        <tr class="total-row">

            <td colspan="9" class="left">
                GRAND TOTAL
            </td>

            <td>
                {{ number_format($grandTotal, 2) }}
            </td>

            <td></td>
            <td></td>

        </tr>

    </table>

    {{-- ================= SIGNATORIES ================= --}}
    <br><br><br>

    <table style="width:100%; border:none;">

        <tr>

            {{-- PREPARED --}}
            <td style="border:none; text-align:center; width:33%;">

                <p style="margin-bottom:40px;">
                    Prepared by:
                </p>

                ___________________________

            </td>

            {{-- REVIEWED --}}
            <td style="border:none; text-align:center; width:33%;">

                <p style="margin-bottom:40px;">
                    Reviewed by:
                </p>

                ___________________________

            </td>

            {{-- APPROVED --}}
            <td style="border:none; text-align:center; width:33%;">

                <p style="margin-bottom:40px;">
                    Approved by:
                </p>

                ___________________________

            </td>

        </tr>

    </table>

</body>

</html>
