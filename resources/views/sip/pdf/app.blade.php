<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #000;
        }

        .header {
            text-align: center;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .header h3,
        .header h4,
        .header p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: middle;
        }

        th {
            font-weight: bold;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .section-row {
            font-weight: bold;
            background: #f2f2f2;
        }

        .small {
            font-size: 7px;
        }

        .remarks {
            font-size: 7px;
        }
    </style>
</head>

<body>

<div class="header">
    <h3>ANNUAL PROCUREMENT PLAN</h3>
    <p>Fiscal Year {{ date('Y') }}</p>
</div>

<table>

    {{-- TOP HEADER --}}
    <tr>
        <th rowspan="2" width="14%">
            Project Title
        </th>

        <th rowspan="2" width="8%">
            End-User or Implementing Unit
        </th>

        <th rowspan="2" width="12%">
            General Description of the Project
        </th>

        <th rowspan="2" width="7%">
            Mode of Procurement
        </th>

        <th rowspan="2" width="6%">
            To be covered by an Early Procurement Activity?
            <br>
            (Yes/No)
        </th>

        <th rowspan="2" width="6%">
            as
        </th>

        <th colspan="2" width="12%">
            PROJECTED TIMELINE
            <br>
            (MM/YYYY)
        </th>

        <th colspan="2" width="14%">
            FUNDING DETAILS
        </th>

        <th rowspan="2" width="9%">
            PROCUREMENT STRATEGY OR TOOLS
        </th>

        <th rowspan="2" width="12%">
            REMARKS
        </th>
    </tr>

    {{-- SECOND HEADER --}}
    <tr>
        <th>
            Start of Procurement Activity
        </th>

        <th>
            End of Procurement Activity
        </th>

        <th>
            Source of Fund
        </th>

        <th>
            Estimated Budget /
            Approved Budget for the Contract (PhP)
        </th>
    </tr>

    {{-- COLUMN LABELS --}}
    <tr class="small">
        <th>Column 1</th>
        <th>Column 2</th>
        <th>Column 3</th>
        <th>Column 4</th>
        <th>Column 5</th>
        <th>Column 6</th>
        <th>Column 7</th>
        <th>Column 8</th>
        <th>Column 9</th>
        <th>Column 10</th>
        <th>Column 11</th>
        <th>Column 12</th>
    </tr>

    <tbody>

    @foreach($procurements->groupBy('category_title') as $category => $items)

        {{-- CATEGORY --}}
        <tr class="section-row">
            <td colspan="12" class="left">
                {{ strtoupper($category) }}
            </td>
        </tr>

        {{-- ROWS --}}
        @foreach($items as $item)

            <tr>

                {{-- COLUMN 1 --}}
                <td class="left">
                    {{ $item->project_title }}
                </td>

                {{-- COLUMN 2 --}}
                <td class="left">
                    {{ $item->end_user_unit }}
                </td>

                {{-- COLUMN 3 --}}
                <td class="left">
                    {{ $item->project_description }}
                </td>

                {{-- COLUMN 4 --}}
                <td>
                    {{ $item->mode_of_procurement }}
                </td>

                {{-- COLUMN 5 --}}
                <td>
                    {{ $item->early_procurement }}
                </td>

                {{-- COLUMN 6 --}}
                <td>
                    {{ $item->early_procurement_details }}
                </td>

                {{-- COLUMN 7 --}}
                <td>
                    {{ $item->start_date
                        ? \Carbon\Carbon::parse($item->start_date)->format('d-M-y')
                        : ''
                    }}
                </td>

                {{-- COLUMN 8 --}}
                <td>
                    {{ $item->end_date
                        ? \Carbon\Carbon::parse($item->end_date)->format('d-M-y')
                        : ''
                    }}
                </td>

                {{-- COLUMN 9 --}}
                <td class="left">
                    {{ $item->source_of_fund }}
                </td>

                {{-- COLUMN 10 --}}
                <td>
                    {{ number_format($item->approved_budget, 2) }}
                </td>

                {{-- COLUMN 11 --}}
                <td class="left">
                    {{ $item->procurement_strategy }}
                </td>

                {{-- COLUMN 12 --}}
                <td class="left remarks">
                    {{ $item->remarks }}
                </td>

            </tr>

        @endforeach

    @endforeach

    </tbody>

</table>

<br><br>

<table style="width:100%; border:none;">
    <tr>

        <td style="border:none; text-align:center;">
            Prepared by:
            <br><br><br>

            <strong>
                _______________________
            </strong>
            <br>
            School APP Focal
        </td>

        <td style="border:none; text-align:center;">
            Approved by:
            <br><br><br>

            <strong>
                _______________________
            </strong>
            <br>
            School Head
        </td>

    </tr>
</table>

</body>
</html>
