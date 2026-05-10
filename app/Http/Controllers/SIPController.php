<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        ->where('sip_approvers.sip_id', $id)
        ->select(
            'sip_approvers.*',
            'users.first_name',
            'users.last_name',
            'users.initial'
        )
        ->get();

        $codes = DB::table('codes')
        ->leftjoin('sub_categories','sub_categories.sub_category_id','codes.sub_category_id')
        ->get();

    return view('sip.manage', compact('sip', 'approvers','aip','codes'));
}


public function storeProcurement(Request $request, $id)
{
    $request->validate([
        'code_id' => 'required',
        'description' => 'required|string',
    ]);
    // dd(session('usrUuId'));

    DB::beginTransaction();

    try {
        $procurementId = DB::table('procurements')->insertGetId([
            'sip_id'     => $id,
            'code_id'    => $request->code_id,
            'created_at' => now(),
            'user_id'    => session('usrUuId'),
            'delete_flag'   => 'n'

        ]);

        DB::table('procurement_components')->insert([
            'procurement_id' => $procurementId,
            'description'    => $request->description,
            'created_at'     => now(),
            'delete_flag'   => 'n'
        ]);

        DB::commit();

        return redirect()
            ->back()
            ->with('successMessage', 'Procurement created successfully.');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()
            ->back()
            ->with('errorMessage', 'Failed to create procurement.');
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
