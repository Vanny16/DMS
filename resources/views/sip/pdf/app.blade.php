<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 20px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #000;
        }

        .header {
            text-align: center;
            font-weight: bold;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px 3px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .left { text-align: left; }
        .bold { font-weight: bold; }
        .no-border { border: none !important; }
        .section-title {
            text-align: left;
            font-weight: bold;
            font-size: 10px;
        }

        .summary-table {
            margin-top: 25px;
        }

        .signature-table {
            margin-top: 60px;
        }

        .signature-table td {
            border: none;
            text-align: center;
            font-size: 10px;
        }

        .sign-name {
            font-weight: bold;
            font-size: 11px;
        }
    </style>
</head>

<body>

<div class="header">
    DEPARTMENT OF EDUCATION <br>
    Region XI <br>
    Division of Davao del Norte <br>
    District of Sto. Tomas West <br>
    TALOS ELEMENTARY SCHOOL <br>
    ANNUAL PROCUREMENT PLAN, FISCAL YEAR 2025
</div>

<table>
    <thead>
        <tr>
            <th rowspan="2">Activity</th>
            <th rowspan="2">Code</th>
            <th rowspan="2">Items &<br>Specification</th>
            <th rowspan="2">Unit of<br>Measure</th>

            <th colspan="20">Monthly Quarterly Requirement</th>

            <th rowspan="2">Total<br>Quantity<br>for the<br>Year</th>
            <th rowspan="2">Price<br>Catalogue</th>
            <th rowspan="2">Total<br>Amount<br>for the<br>Year</th>
        </tr>

        <tr>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Q1</th>
            <th>Q1<br>Amount</th>

            <th>Apr</th>
            <th>May</th>
            <th>June</th>
            <th>Q2</th>
            <th>Q2<br>Amount</th>

            <th>July</th>
            <th>Aug</th>
            <th>Sept</th>
            <th>Q3</th>
            <th>Q3<br>Amount</th>

            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
            <th>Q4</th>
            <th>Q4<br>Amount</th>
        </tr>
    </thead>

    <tbody>
        @php
            $grandQ1Amount = 0;
            $grandQ2Amount = 0;
            $grandQ3Amount = 0;
            $grandQ4Amount = 0;
            $grandTotalAmount = 0;
            $grandTotalQty = 0;
        @endphp

        @foreach ($procurements->groupBy('description') as $description => $items)
            <tr>
                <td colspan="27" class="section-title">
                    {{ strtoupper($description) }}
                </td>
            </tr>

            @php
                $subQ1Amount = 0;
                $subQ2Amount = 0;
                $subQ3Amount = 0;
                $subQ4Amount = 0;
                $subTotalAmount = 0;
                $subTotalQty = 0;
            @endphp

            @foreach ($items as $item)
                @if($item->procurement_item_id)
                    @php
                        $itemMonths = $months[$item->procurement_item_id] ?? collect();

                        $jan = optional($itemMonths->firstWhere('month_id', 1))->quantity ?? 0;
                        $feb = optional($itemMonths->firstWhere('month_id', 2))->quantity ?? 0;
                        $mar = optional($itemMonths->firstWhere('month_id', 3))->quantity ?? 0;

                        $apr = optional($itemMonths->firstWhere('month_id', 4))->quantity ?? 0;
                        $may = optional($itemMonths->firstWhere('month_id', 5))->quantity ?? 0;
                        $jun = optional($itemMonths->firstWhere('month_id', 6))->quantity ?? 0;

                        $jul = optional($itemMonths->firstWhere('month_id', 7))->quantity ?? 0;
                        $aug = optional($itemMonths->firstWhere('month_id', 8))->quantity ?? 0;
                        $sep = optional($itemMonths->firstWhere('month_id', 9))->quantity ?? 0;

                        $oct = optional($itemMonths->firstWhere('month_id', 10))->quantity ?? 0;
                        $nov = optional($itemMonths->firstWhere('month_id', 11))->quantity ?? 0;
                        $dec = optional($itemMonths->firstWhere('month_id', 12))->quantity ?? 0;

                        $q1 = $jan + $feb + $mar;
                        $q2 = $apr + $may + $jun;
                        $q3 = $jul + $aug + $sep;
                        $q4 = $oct + $nov + $dec;

                        $price = $item->amount ?? 0;

                        $q1Amount = $q1 * $price;
                        $q2Amount = $q2 * $price;
                        $q3Amount = $q3 * $price;
                        $q4Amount = $q4 * $price;

                        $totalQty = $q1 + $q2 + $q3 + $q4;
                        $totalAmount = $totalQty * $price;

                        $subQ1Amount += $q1Amount;
                        $subQ2Amount += $q2Amount;
                        $subQ3Amount += $q3Amount;
                        $subQ4Amount += $q4Amount;
                        $subTotalAmount += $totalAmount;
                        $subTotalQty += $totalQty;

                        $grandQ1Amount += $q1Amount;
                        $grandQ2Amount += $q2Amount;
                        $grandQ3Amount += $q3Amount;
                        $grandQ4Amount += $q4Amount;
                        $grandTotalAmount += $totalAmount;
                        $grandTotalQty += $totalQty;
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->code }}</td>
                        <td class="left">{{ $item->item_name }}</td>
                        <td>{{ $item->unit_of_measure }}</td>

                        <td>{{ $jan }}</td>
                        <td>{{ $feb }}</td>
                        <td>{{ $mar }}</td>
                        <td>{{ $q1 }}</td>
                        <td>{{ number_format($q1Amount, 2) }}</td>

                        <td>{{ $apr }}</td>
                        <td>{{ $may }}</td>
                        <td>{{ $jun }}</td>
                        <td>{{ $q2 }}</td>
                        <td>{{ number_format($q2Amount, 2) }}</td>

                        <td>{{ $jul }}</td>
                        <td>{{ $aug }}</td>
                        <td>{{ $sep }}</td>
                        <td>{{ $q3 }}</td>
                        <td>{{ number_format($q3Amount, 2) }}</td>

                        <td>{{ $oct }}</td>
                        <td>{{ $nov }}</td>
                        <td>{{ $dec }}</td>
                        <td>{{ $q4 }}</td>
                        <td>{{ number_format($q4Amount, 2) }}</td>

                        <td>{{ $totalQty }}</td>
                        <td>{{ number_format($price, 2) }}</td>
                        <td>{{ number_format($totalAmount, 2) }}</td>
                    </tr>
                @endif
            @endforeach

            <tr class="bold">
                <td colspan="4">TOTAL</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ1Amount, 2) }}</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ2Amount, 2) }}</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ3Amount, 2) }}</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ4Amount, 2) }}</td>
                <td>{{ $subTotalQty }}</td>
                <td></td>
                <td>{{ number_format($subTotalAmount, 2) }}</td>
            </tr>

            <tr class="bold">
                <td colspan="4">SUB TOTAL</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ1Amount, 2) }}</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ2Amount, 2) }}</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ3Amount, 2) }}</td>
                <td colspan="4"></td>
                <td>{{ number_format($subQ4Amount, 2) }}</td>
                <td>{{ $subTotalQty }}</td>
                <td></td>
                <td>{{ number_format($subTotalAmount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="summary-table">
    <tr>
        <th></th>
        <th>Q1</th>
        <th>Q2</th>
        <th>Q3</th>
        <th>Q4</th>
        <th>Total Amount</th>
    </tr>

    <tr>
        <td class="left bold">Quarterly Utilization</td>
        <td>{{ number_format($grandQ1Amount, 2) }}</td>
        <td>{{ number_format($grandQ2Amount, 2) }}</td>
        <td>{{ number_format($grandQ3Amount, 2) }}</td>
        <td>{{ number_format($grandQ4Amount, 2) }}</td>
        <td>{{ number_format($grandTotalAmount, 2) }}</td>
    </tr>

    <tr>
        <td class="left bold">Quarterly Allocation</td>
        <td>{{ number_format($grandQ1Amount, 2) }}</td>
        <td>{{ number_format($grandQ2Amount, 2) }}</td>
        <td>{{ number_format($grandQ3Amount, 2) }}</td>
        <td>{{ number_format($grandQ4Amount, 2) }}</td>
        <td>{{ number_format($grandTotalAmount, 2) }}</td>
    </tr>

    <tr>
        <td class="left bold">Percentage of Quarterly Utilization</td>
        <td>{{ $grandTotalAmount > 0 ? round(($grandQ1Amount / $grandTotalAmount) * 100) : 0 }}%</td>
        <td>{{ $grandTotalAmount > 0 ? round(($grandQ2Amount / $grandTotalAmount) * 100) : 0 }}%</td>
        <td>{{ $grandTotalAmount > 0 ? round(($grandQ3Amount / $grandTotalAmount) * 100) : 0 }}%</td>
        <td>{{ $grandTotalAmount > 0 ? round(($grandQ4Amount / $grandTotalAmount) * 100) : 0 }}%</td>
        <td>100%</td>
    </tr>

    <tr>
        <td class="left bold">MOOE Fund</td>
        <td>{{ number_format($grandQ1Amount, 2) }}</td>
        <td>{{ number_format($grandQ2Amount, 2) }}</td>
        <td>{{ number_format($grandQ3Amount, 2) }}</td>
        <td>{{ number_format($grandQ4Amount, 2) }}</td>
        <td>{{ number_format($grandTotalAmount, 2) }}</td>
    </tr>
</table>

<table class="signature-table">
    <tr>
        <td>Prepared by:</td>
        <td>Check and Verified:</td>
        <td>Certified Funds Available:</td>
        <td>Approved:</td>
    </tr>

    <tr><td colspan="4" style="height: 35px;"></td></tr>

    <tr>
        <td class="sign-name">Ralph T. Mendoza</td>
        <td class="sign-name">Roel P. Dela Cruz</td>
        <td class="sign-name">James Z. Lay</td>
        <td class="sign-name">Lare Y. Gale</td>
    </tr>

    <tr>
        <td>School Head</td>
        <td>Chief-Schools Governance Operations Division</td>
        <td>Budget Officer</td>
        <td>Schools Division Superintendent</td>
    </tr>
</table>

</body>
</html>
