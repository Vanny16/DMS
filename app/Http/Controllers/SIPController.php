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
        return redirect()->route('sip.main')->with('error', 'SIP not found.');
    }

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

    return view('sip.manage', compact('sip', 'approvers'));
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
