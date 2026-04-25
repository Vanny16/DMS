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
    dd($request->all());
    $request->validate([
        'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        'budget_allocation' => 'required',
        'approver_ids' => 'required|array|min:1|max:3',
    ]);

    DB::beginTransaction();

    try {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/sip'), $fileName);

        $sip_id = DB::table('sips')->insertGetId([
            'file_name' => $fileName,
            'budget_allocation' => $request->budget_allocation,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($request->approver_ids as $approver_id) {
            DB::table('sip_approvers')->insert([
                'sip_id' => $sip_id,
                'user_id' => $approver_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::commit();

        return redirect()->back()->with('success', 'SIP created successfully.');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->with('error', 'Failed to create SIP: ' . $e->getMessage());
    }
}

}
