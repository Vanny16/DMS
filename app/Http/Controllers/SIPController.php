<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PDF;


class SIPController extends Controller
{
    public function main()
    {

    $sip_list = DB::table('sips')
        ->join('statuses','statuses.status_id','=','sips.status_id')
        ->orderBy('sips.created_at', 'desc')
        ->get();

    $sip_approvers = DB::table('sip_approvers')
        ->join('users','users.user_id','=','sip_approvers.user_id')
        ->get();

    $users = DB::table('users')
    ->get();

        return view('sip.main', compact('sip_list', 'sip_approvers', 'users'));
    }

    public function save(Request $request)
{
    // $request->validate([
    //     'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
    //     'budget_allocation' => 'required',
    //     'approver_ids' => 'required|array|min:1|max:3',
    // ]);

    // DB::beginTransaction();

    // try {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/sip'), $fileName);

        $sip_id = DB::table('sips')->insertGetId([
            'file_name' => $fileName,
            'budget_allocation' => $request->budget_allocation,
            'status_id' => 1,
            'completion_flag' => 'n',
            'delete_flag' => 'n',
            'created_at' => now(),
            'user_id' => session('usrUuId'),
        ]);

        foreach ($request->approver_ids as $approver_id) {
            DB::table('sip_approvers')->insert([
                'sip_id' => $sip_id,
                'user_id' => $approver_id,
                'created_at' => now(),
                'approver_status_id' => 4,

            ]);
        }

        // DB::commit();

        return redirect()->back()->with('successMessage', 'SIP created successfully.');

    // } catch (\Exception $e) {
    //     DB::rollBack();

    //     return redirect()->back()->with('errorMessage', 'Failed to create SIP: ' . $e->getMessage());
    // }
}

public function manage($id)
{
    $sip = DB::table('sips')
        ->join('statuses', 'statuses.status_id', '=', 'sips.status_id')
        ->where('sips.sip_id', $id)
        ->select('sips.*', 'statuses.status')
        ->first();

    if (!$sip) {
        return redirect()->route('sip.main')->with('errorMessage', 'SIP not found.');
    }

        $aip = DB::table('aips')
        ->where('sip_id', $id)
        ->first();

    $approvers = DB::table('sip_approvers')
        ->join('users', 'users.user_id', '=', 'sip_approvers.user_id')
        ->join('positions', 'positions.position_id', '=', 'users.position_id')
        ->where('sip_approvers.sip_id', $id)
        ->select(
            'sip_approvers.*',
            'users.first_name',
            'users.last_name',
            'users.initial',
            'positions.position'
        )
        ->get();

        $codes = DB::table('codes')
        ->leftjoin('sub_categories','sub_categories.sub_category_id','codes.sub_category_id')
        ->get();

    $usedBudget = DB::table('procurements')
        ->join(
            'procurement_components',
            'procurement_components.procurement_id',
            '=',
            'procurements.procurement_id'
        )
        // ->join(
        //     'procurement_items',
        //     'procurement_items.procurement_component_id',
        //     '=',
        //     'procurement_components.procurement_component_id'
        // )
        ->where('procurements.sip_id', $id)
        ->where('procurements.delete_flag', 'n')
        ->where('procurement_components.delete_flag', 'n')
        // ->where('procurement_items.delete_flag', 'n')
        // ->sum('procurement_items.amount');
        ->sum('procurement_components.approved_budget');

    $budgetAllocation = (float) $sip->budget_allocation;

    $remainingBudget = $budgetAllocation - $usedBudget;

    return view('sip.manage', compact('sip', 'approvers','aip','codes','usedBudget','remainingBudget','budgetAllocation'));
}

public function procurementList($id)
{
    $sip = DB::table('sips')
        ->where('sip_id', $id)
        ->first();

    // $procurements = DB::table('procurements')
    //     ->join('codes', 'codes.code_id', '=', 'procurements.code_id')
    //     ->leftJoin('procurement_components', 'procurement_components.procurement_id', '=', 'procurements.procurement_id')
    //     ->leftJoin('procurement_items', 'procurement_items.procurement_component_id', '=', 'procurement_components.procurement_component_id')
    //     ->where('procurements.sip_id', $id)
    //     ->select(
    //         'procurements.procurement_id',
    //         'procurements.sip_id',
    //         'codes.code',
    //         'procurement_components.procurement_component_id',
    //         'procurement_components.description',
    //         'procurements.created_at',
    //         DB::raw('COALESCE(SUM(procurement_items.amount), 0) as total_amount')
    //     )
    //     ->groupBy(
    //         'procurements.procurement_id',
    //         'procurements.sip_id',
    //         'codes.code',
    //         'procurement_components.procurement_component_id',
    //         'procurement_components.description',
    //         'procurements.created_at'
    //     )
    //     ->orderBy('procurements.procurement_id', 'desc')
    //     ->get();


            $procurements = DB::table('procurements')
            ->join(
                'codes',
                'codes.code_id',
                '=',
                'procurements.code_id'
            )

            ->join(
                'procurement_components',
                'procurement_components.procurement_id',
                '=',
                'procurements.procurement_id'
            )

            ->leftJoin(
                'procurement_items',
                'procurement_items.procurement_component_id',
                '=',
                'procurement_components.procurement_component_id'
            )

            ->where('procurements.sip_id', $id)

            ->select(

                // PROCUREMENT
                'procurements.procurement_id',
                'codes.code as category_title',

                // CODE
                'codes.code',

                // COMPONENT
                'procurement_components.procurement_component_id',

                'procurement_components.description as project_title',
                'procurement_components.description',

                'procurement_components.end_user_unit',
                'procurement_components.project_description',
                'procurement_components.mode_of_procurement',
                'procurement_components.early_procurement',
                'procurement_components.early_procurement_details',
                'procurement_components.start_date',
                'procurement_components.end_date',
                'procurement_components.source_of_fund',
                'procurement_components.approved_budget',
                'procurement_components.procurement_strategy',
                'procurement_components.remarks',

                // ITEMS
                'procurement_items.procurement_item_id',
                'procurement_items.item_name',
                'procurement_items.unit_of_measure',
                'procurement_items.amount',
                'procurement_items.year',
                'procurement_items.mode_of_procurement as item_mode_of_procurement',

                DB::raw('COALESCE(SUM(procurement_items.approved_budget), 0) as total_amount')

            )

            ->orderBy('codes.code', 'asc')
            ->orderBy('procurements.procurement_id', 'asc')
            ->get();

    return view('sip.procurement_list', compact('sip', 'procurements'));
}
public function procurementItems($procurement_id)
{
    $procurement = DB::table('procurements')
        ->join('codes', 'codes.code_id', '=', 'procurements.code_id')
        ->leftJoin('procurement_components', 'procurement_components.procurement_id', '=', 'procurements.procurement_id')
        ->where('procurements.procurement_id', $procurement_id)
        ->select(
            'procurements.procurement_id',
            'procurements.sip_id',
            'codes.code',
            'procurement_components.procurement_component_id',
            'procurement_components.description'

        )
        ->first();

    $items = DB::table('procurement_items')
        ->where('procurement_component_id', $procurement->procurement_component_id)
        ->orderBy('procurement_item_id', 'desc')
        ->get();

    return view('sip.procurement_items', compact('procurement', 'items'));
}


    // public function generateAPP($sip_id)
    // {
    //     $sip = DB::table('sips')
    //         ->where('sip_id', $sip_id)
    //         ->first();

    //     $procurements = DB::table('procurements')
    //         ->join('codes', 'codes.code_id', '=', 'procurements.code_id')

    //         ->join(
    //             'procurement_components',
    //             'procurement_components.procurement_id',
    //             '=',
    //             'procurements.procurement_id'
    //         )

    //         ->leftJoin(
    //             'procurement_items',
    //             'procurement_items.procurement_component_id',
    //             '=',
    //             'procurement_components.procurement_component_id'
    //         )

    //         ->where('procurements.sip_id', $sip_id)

    //         ->select(
    //             'procurements.procurement_id',
    //             'codes.code',

    //             'procurement_components.procurement_component_id',
    //             'procurement_components.description',

    //             'procurement_items.procurement_item_id',
    //             'procurement_items.item_name',
    //             'procurement_items.unit_of_measure',
    //             'procurement_items.amount',
    //             'procurement_items.year',
    //             'procurement_items.mode_of_procurement'
    //         )

    //         ->orderBy('codes.code', 'asc')
    //         ->get();

    //     $itemIds = $procurements
    //         ->pluck('procurement_item_id')
    //         ->filter();

    //     $months = DB::table('procurement_item_months')
    //         ->whereIn('procurement_item_id', $itemIds)
    //         ->get()
    //         ->groupBy('procurement_item_id');

    //     $pdf = PDF::loadView(
    //         'sip.pdf.app',
    //         compact(
    //             'sip',
    //             'procurements',
    //             'months'
    //         )
    //     );

    //     $pdf->setPaper('legal', 'landscape');

    //     return $pdf->stream('annual-procurement-plan.pdf');
    // }

    public function generateAPP($sip_id)
    {
        $sip = DB::table('sips')
            ->where('sip_id', $sip_id)
            ->first();

        $procurements = DB::table('procurements')
            ->join(
                'codes',
                'codes.code_id',
                '=',
                'procurements.code_id'
            )

            ->join(
                'procurement_components',
                'procurement_components.procurement_id',
                '=',
                'procurements.procurement_id'
            )

            ->leftJoin(
                'procurement_items',
                'procurement_items.procurement_component_id',
                '=',
                'procurement_components.procurement_component_id'
            )

            ->where('procurements.sip_id', $sip_id)

            ->select(

                // PROCUREMENT
                'procurements.procurement_id',
                'codes.code as category_title',

                // CODE
                'codes.code',

                // COMPONENT
                'procurement_components.procurement_component_id',

                'procurement_components.description as project_title',
                'procurement_components.description',

                'procurement_components.end_user_unit',
                'procurement_components.project_description',
                'procurement_components.mode_of_procurement',
                'procurement_components.early_procurement',
                'procurement_components.early_procurement_details',
                'procurement_components.start_date',
                'procurement_components.end_date',
                'procurement_components.source_of_fund',
                'procurement_components.approved_budget',
                'procurement_components.procurement_strategy',
                'procurement_components.remarks',

                // ITEMS
                'procurement_items.procurement_item_id',
                'procurement_items.item_name',
                'procurement_items.unit_of_measure',
                'procurement_items.amount',
                'procurement_items.year',
                'procurement_items.mode_of_procurement as item_mode_of_procurement'
            )

            ->orderBy('codes.code', 'asc')
            ->orderBy('procurements.procurement_id', 'asc')
            ->get();

        $itemIds = $procurements
            ->pluck('procurement_item_id')
            ->filter();

        $months = DB::table('procurement_item_months')
            ->whereIn('procurement_item_id', $itemIds)
            ->get()
            ->groupBy('procurement_item_id');

        $pdf = PDF::loadView(
            'sip.pdf.app',
            compact(
                'sip',
                'procurements',
                'months'
            )
        );

        $pdf->setPaper('legal', 'landscape');

        return $pdf->stream('annual-procurement-plan.pdf');
    }


public function storeProcurementItem(Request $request, $procurement_component_id)
{
    $request->validate([
        'item_name' => 'required|string',
        'mode_of_procurement' => 'required|string',
        'amount' => 'required|numeric',
        'unit_of_measure' => 'required|string',
        'year' => 'required',
        'months' => 'required|array',
        'quantities' => 'required|array',
    ]);

    DB::beginTransaction();

    try {
        $itemId = DB::table('procurement_items')->insertGetId([
            'procurement_component_id' => $procurement_component_id,
            'item_name' => $request->item_name,
            'mode_of_procurement' => $request->mode_of_procurement,
            'amount' => $request->amount,
            'unit_of_measure' => $request->unit_of_measure,
            'year' => $request->year,
            'delete_flag' => 'n',
            'created_at' => now(),
        ]);

        $monthMap = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];

        foreach ($request->months as $monthName) {
            DB::table('procurement_item_months')->insert([
                'procurement_item_id' => $itemId,
                'month_id' => $monthMap[$monthName],
                'month' => $monthName,
                'quantity' => $request->quantities[$monthName] ?? 0,
                'created_at' => now(),
            ]);
        }

        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Procurement item saved successfully.');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()
            ->back()
            ->with('error', 'Failed to save procurement item.');
    }
}

// public function storeProcurement(Request $request, $id)
// {
//     $request->validate([
//         'code_id' => 'required',
//         'description' => 'required|string',
//     ]);
//     // dd(session('usrUuId'));

//     DB::beginTransaction();

//     try {
//         $procurementId = DB::table('procurements')->insertGetId([
//             'sip_id'     => $id,
//             'code_id'    => $request->code_id,
//             'created_at' => now(),
//             'user_id'    => session('usrUuId'),
//             'delete_flag'   => 'n'

//         ]);

//         DB::table('procurement_components')->insert([
//             'procurement_id' => $procurementId,
//             'description'    => $request->description,
//             'created_at'     => now(),
//             'delete_flag'   => 'n'
//         ]);

//         DB::commit();

//         return redirect()
//             ->back()
//             ->with('successMessage', 'Procurement created successfully.');

//     } catch (\Exception $e) {
//         DB::rollBack();

//         return redirect()
//             ->back()
//             ->with('errorMessage', 'Failed to create procurement.');
//     }
// }

public function storeProcurement(Request $request, $id)
{
    $request->validate([

        'code_id'                    => 'required',

        'project_title'              => 'required|string',

        'end_user_unit'              => 'nullable|string',

        'project_description'        => 'nullable|string',

        'mode_of_procurement'        => 'nullable|string',

        'early_procurement'          => 'nullable|string',

        'early_procurement_details'  => 'nullable|string',

        'start_date'                 => 'nullable|date',

        'end_date'                   => 'nullable|date',

        'source_of_fund'             => 'nullable|string',

        'approved_budget'            => 'nullable|numeric',

        'procurement_strategy'       => 'nullable|string',

        'remarks'                    => 'nullable|string',
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | INSERT PROCUREMENT
        |--------------------------------------------------------------------------
        */

        $procurementId = DB::table('procurements')->insertGetId([

            'sip_id'       => $id,

            'code_id'      => $request->code_id,

            'user_id'      => session('usrUuId'),

            'delete_flag'  => 'n',

            'created_at'   => now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | INSERT PROCUREMENT COMPONENT
        |--------------------------------------------------------------------------
        */

        DB::table('procurement_components')->insert([

            'procurement_id'              => $procurementId,

            // OLD DESCRIPTION
            'description'                 => $request->project_title,

            'end_user_unit'               => $request->end_user_unit,

            'project_description'         => $request->project_description,

            'mode_of_procurement'         => $request->mode_of_procurement,

            'early_procurement'           => $request->early_procurement,

            'early_procurement_details'   => $request->early_procurement_details,

            'start_date'                  => $request->start_date,

            'end_date'                    => $request->end_date,

            'source_of_fund'              => $request->source_of_fund,

            'approved_budget'             => $request->approved_budget ?? 0,

            'procurement_strategy'        => $request->procurement_strategy,

            'remarks'                     => $request->remarks,

            'delete_flag'                 => 'n',

            'created_at'                  => now(),

        ]);

        DB::commit();

        return redirect()
            ->back()
            ->with(
                'successMessage',
                'Procurement created successfully.'
            );

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()
            ->back()
            ->with(
                'errorMessage',
                'Failed to create procurement.'
            );
    }
}

public function update(Request $request, $id)
{
    $request->validate([
        'budget_allocation' => 'required',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
    ]);

    $data = [
        'budget_allocation' => $request->budget_allocation,
        'updated_at' => now(),
    ];

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/sip'), $fileName);

        $data['file_name'] = $fileName;
    }

    DB::table('sips')
        ->where('sip_id', $id)
        ->update($data);

    return redirect()->back()->with('success', 'SIP updated successfully.');
}

public function updateAip(Request $request, $id)
{
    $request->validate([
        'aip_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    DB::beginTransaction();

    try {

        // upload file
        $file = $request->file('aip_file');
        $fileName = time() . '_AIP_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/aip'), $fileName);

        $existing = DB::table('aips')
            ->where('sip_id', $id)
            ->where('status_id', 1)
            ->first();

        if ($existing) {

            // UPDATE
            DB::table('aips')
                ->where('sip_id', $id)
                ->where('status_id', 1)
                ->update([
                    'file_name' => $fileName,
                    'updated_at' => now(),
                    'user_id' => session('usrUuId'),
                    'completion_flag' => 'n',
                    'delete_flag' => 'n',
                ]);

        } else {

            // INSERT
            DB::table('aips')->insert([
                'sip_id' => $id,
                'file_name' => $fileName,
                'status_id' => 1,
                'user_id' => session('usrUuId'),
                'completion_flag' => 'n',
                'delete_flag' => 'n',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::commit();

        return redirect()->back()->with('successMessage', 'AIP saved successfully.');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->with('errorMessage', 'Error: ' . $e->getMessage());
    }
}

}
