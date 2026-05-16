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
            font-size: 7px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            font-weight: bold;
        }

        .left {
            text-align: left;
        }

        .category {
            background: #ffe600;
            font-weight: bold;
            text-transform: uppercase;
        }

        .total-row {
            background: #ffe600;
            font-weight: bold;
        }

        .wrap {
            word-wrap: break-word;
        }

        .header {
            text-align: center;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .header h2,
        .header h3,
        .header h4,
        .header p {
            margin: 0;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <p>Republic of the Philippines</p>
        <h3>DEPARTMENT OF EDUCATION</h3>
        <p>Region XI</p>
        <h4>DIVISION OF DAVAO DEL NORTE</h4>
        <h4>{{ strtoupper($sip->school_name ?? 'SCHOOL NAME') }}</h4>

        <br>

        <h3>WORK AND FINANCIAL PLAN FY {{ date('Y') }}</h3>
    </div>

    {{-- MAIN TABLE --}}
    <table>

        {{-- HEADER --}}
        <tr>
            <th rowspan="2">CODE</th>
            <th rowspan="2">ACTIVITY</th>
            <th rowspan="2">PERFORMANCE INDICATOR</th>
            <th colspan="4">Q1</th>
            <th colspan="4">Q2</th>
            <th colspan="4">Q3</th>
            <th colspan="4">Q4</th>
            <th rowspan="2">TOTAL</th>
            <th rowspan="2">RESPONSIBILITY CENTER</th>
            <th rowspan="2">SOURCE OF FUND</th>
            <th rowspan="2">REMARKS</th>
        </tr>

        <tr>
            <th>JAN</th>
            <th>FEB</th>
            <th>MAR</th>
            <th>Total</th>
            <th>APR</th>
            <th>MAY</th>
            <th>JUN</th>
            <th>Total</th>
            <th>JUL</th>
            <th>AUG</th>
            <th>SEP</th>
            <th>Total</th>
            <th>OCT</th>
            <th>NOV</th>
            <th>DEC</th>
            <th>Total</th>
        </tr>

        @php
            $grandQ1 = 0;
            $grandQ2 = 0;
            $grandQ3 = 0;
            $grandQ4 = 0;
            $grandTotal = 0;

            $grouped = collect($report)->groupBy('code');
        @endphp

        @foreach ($grouped as $code => $components)
            @php
                $catQ1 = 0;
                $catQ2 = 0;
                $catQ3 = 0;
                $catQ4 = 0;
                $catTotal = 0;
            @endphp

            {{-- ================= CATEGORY HEADER ================= --}}
            <tr class="category">
                <td colspan="23" class="left">
                    {{ $code }}
                </td>
            </tr>

            {{-- ================= COMPONENTS ================= --}}
            @foreach ($components as $group)
                @php
                    $m = $group['monthly'];
                    $q1 = $group['q1'];
                    $q2 = $group['q2'];
                    $q3 = $group['q3'];
                    $q4 = $group['q4'];
                    $total = $group['total'];

                    $catQ1 += $q1;
                    $catQ2 += $q2;
                    $catQ3 += $q3;
                    $catQ4 += $q4;
                    $catTotal += $total;

                    $grandQ1 += $q1;
                    $grandQ2 += $q2;
                    $grandQ3 += $q3;
                    $grandQ4 += $q4;
                    $grandTotal += $total;
                @endphp

                <tr>
                    <td></td>
                    <td class="left">
                        {{ $group['component']->project_title }}
                    </td>

                    <td class="left">
                        {{ $group['component']->performance_indicator ?? '-' }}
                    </td>

                    <td>{{ number_format($m[1], 2) }}</td>
                    <td>{{ number_format($m[2], 2) }}</td>
                    <td>{{ number_format($m[3], 2) }}</td>
                    <td>{{ number_format($q1, 2) }}</td>

                    <td>{{ number_format($m[4], 2) }}</td>
                    <td>{{ number_format($m[5], 2) }}</td>
                    <td>{{ number_format($m[6], 2) }}</td>
                    <td>{{ number_format($q2, 2) }}</td>

                    <td>{{ number_format($m[7], 2) }}</td>
                    <td>{{ number_format($m[8], 2) }}</td>
                    <td>{{ number_format($m[9], 2) }}</td>
                    <td>{{ number_format($q3, 2) }}</td>

                    <td>{{ number_format($m[10], 2) }}</td>
                    <td>{{ number_format($m[11], 2) }}</td>
                    <td>{{ number_format($m[12], 2) }}</td>
                    <td>{{ number_format($q4, 2) }}</td>

                    <td>{{ number_format($total, 2) }}</td>

                    <td class="left">
                        {{ $group['component']->end_user_unit ?? '-' }}
                    </td>

                    <td class="left">
                        {{ $group['component']->source_of_fund ?? '-' }}
                    </td>

                    <td class="left">
                        {{ $group['component']->remarks ?? '-' }}
                    </td>

                </tr>
            @endforeach

            {{-- ================= CATEGORY TOTAL ROW ================= --}}
            <tr class="total-row">
                <td colspan="2" class="left">
                    TOTAL {{ $code }}
                </td>

                <td></td>

                <td></td>
                <td></td>

                <td></td>
                <td>{{ number_format($catQ1, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
                <td>{{ number_format($catQ2, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
                <td>{{ number_format($catQ3, 2) }}</td>

                <td></td>
                <td></td>
                <td></td>
                <td>{{ number_format($catQ4, 2) }}</td>

                <td>{{ number_format($catTotal, 2) }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach

        {{-- ================= GRAND TOTAL ================= --}}
        <tr class="total-row">
            <td colspan="2" class="left">
                GRAND TOTAL
            </td>

            <td></td>

            <td></td>
            <td></td>
            <td></td>

            <td>{{ number_format($grandQ1, 2) }}</td>

            <td></td>
            <td></td>
            <td></td>
            <td>{{ number_format($grandQ2, 2) }}</td>

            <td></td>
            <td></td>
            <td></td>
            <td>{{ number_format($grandQ3, 2) }}</td>

            <td></td>
            <td></td>
            <td></td>
            <td>{{ number_format($grandQ4, 2) }}</td>

            <td>{{ number_format($grandTotal, 2) }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <br><br><br>

<table style="width:100%; border:none;">
    <tr>

        {{-- PREPARED BY --}}
        <td style="border:none; width:33%; text-align:center; vertical-align:top;">
            <p style="margin-bottom:40px;">
                Prepared by:
            </p>

            <strong>
                ___________________________
            </strong>
        </td>

        {{-- REVIEWED BY --}}
        <td style="border:none; width:33%; text-align:center; vertical-align:top;">
            <p style="margin-bottom:40px;">
                Reviewed by:
            </p>

            <strong>
                ___________________________
            </strong>
        </td>

        {{-- APPROVED BY --}}
        <td style="border:none; width:33%; text-align:center; vertical-align:top;">
            <p style="margin-bottom:40px;">
                Approved by:
            </p>

            <strong>
                ___________________________
            </strong>
        </td>

    </tr>
</table>
</body>

<style>
    .component-summary {
        background: #ffe600;
        font-weight: bold;
    }
</style>

</html>
