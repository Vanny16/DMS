<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request; // ✅ Correct location
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DtrController extends Controller
{
    public function index(Request $request)
    {
        $typ_id = session('typ_id');
        $accID = session('accID');
        $usrUuId = session('usrUuId');

        $total_reg = 0;
        $total_ot = 0;
        $users = [];

        if (in_array($typ_id, [1, 2])) {
            $usersQuery = DB::table('users as u')
                ->leftJoin('schoolaccounts as s', 'u.accID', '=', 's.accID')
                ->select('u.usrID', 'u.usrType', DB::raw("CONCAT(u.usrFirstName, ' ', u.usrLastName) as emp_name"), 's.accName');

            if ($typ_id == 2) {
                $usersQuery->where('u.accID', $accID);
            }

            if ($request->filled('usr_type')) {
                $typeMap = [
                    'admin' => [1, 2],
                    'faculty' => [3],
                    'student' => [4],
                    'nonteaching' => [5],
                    'programhead' => [6],
                    'sa' => [7]
                ];
                if (isset($typeMap[$request->usr_type])) {
                    $usersQuery->whereIn('u.usrType', $typeMap[$request->usr_type]);
                }
            }

            $users = $usersQuery->get();
            $userIDs = $users->pluck('usrID');

            $dtrs = DB::table('dtr_sams_card')
                ->whereIn('emp_id', $userIDs)
                ->orderBy('tme_date', 'desc')
                ->get()
                ->groupBy('emp_id');

            foreach ($users as $user) {
                $user->dtrs = $dtrs[$user->usrID] ?? collect();
                $user->latest_remarks = $user->dtrs->first()->tme_remarks ?? null;
                $user->latest_admin_remarks = $user->dtrs->first()->tme_admin_remarks ?? null;

                $total_reg += $user->dtrs->sum('tme_reg_total');
                $total_ot += $user->dtrs->sum('tme_ot_total');
            }

            return view('dtr', compact('users', 'total_reg', 'total_ot'));
        }

        $dtrs = DB::table('dtr_sams_card')
            ->where('emp_id', $usrUuId)
            ->orderBy('tme_date', 'desc')
            ->get();

        $total_reg = $dtrs->sum('tme_reg_total');
        $total_ot = $dtrs->sum('tme_ot_total');
        $user = DB::table('users')->where('usrID', $usrUuId)->first();

        return view('user_dtr', compact('user', 'dtrs', 'total_reg', 'total_ot'));
    }

    public function saveAdminRemarks(Request $request)
    {
        $tme_id = $request->input('tme_id');
        $remarks = $request->input('tme_admin_remarks');

        // Update remarks
        DB::table('dtr_sams_card')
            ->where('tme_id', $tme_id)
            ->update(['tme_admin_remarks' => $remarks]);

        // Handle photo upload
        if ($request->hasFile('tme_admin_photo')) {
            $photo = $request->file('tme_admin_photo');
            $filename = 'tme_admin_' . $tme_id . '.jpg';
            $destination = public_path('images/dtr/');

            // Delete the old file if it exists
            if (file_exists($destination . $filename)) {
                unlink($destination . $filename);
            }

            // Save and compress using Intervention Image
            $image = Image::make($photo->getRealPath());
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destination . $filename, 80); // 80% quality

            // Update DB with new photo filename
            DB::table('dtr_sams_card')
                ->where('tme_id', $tme_id)
                ->update(['tme_admin_photo' => $filename]);
        }

        return redirect()->back()->with('success', 'Admin remarks and photo saved.');
    }

    public function saveUserRemarks(Request $request)
    {
        $tme_id = $request->input('tme_id');
        $remarks = $request->input('tme_remarks');

        // Update remarks
        DB::table('dtr_sams_card')
            ->where('tme_id', $tme_id)
            ->update(['tme_remarks' => $remarks]);

        // Handle photo upload
        if ($request->hasFile('tme_photo')) {
            $photo = $request->file('tme_photo');
            $extension = $photo->getClientOriginalExtension();
            $filename = 'tme_' . $tme_id . '.' . $extension;
            $destination = public_path('images/dtr/');

            // Fetch old filename from database
            $oldFile = DB::table('dtr_sams_card')
                ->where('tme_id', $tme_id)
                ->value('tme_photo');

            // Delete old file if it exists
            if ($oldFile && file_exists($destination . $oldFile)) {
                unlink($destination . $oldFile);
            }

            // Save and compress using Intervention Image
            $image = \Intervention\Image\Facades\Image::make($photo->getRealPath());
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destination . $filename, 80); // 80% quality

            // Update the filename in the database
            DB::table('dtr_sams_card')
                ->where('tme_id', $tme_id)
                ->update(['tme_photo' => $filename]);
        }
        return redirect()->back()->with('success', 'Remarks and photo saved.');
    }

    public function addRecord(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|integer',
            'tme_date' => 'required|date',
            'tme_am_in' => 'nullable',
            'tme_am_out' => 'nullable',
            'tme_pm_in' => 'nullable',
            'tme_pm_out' => 'nullable',
            'tme_ot_in' => 'nullable',
            'tme_ot_out' => 'nullable',
        ]);

        DB::table('dtr_sams_card')->insert([
            'emp_id' => $request->emp_id,
            'tme_date' => $request->tme_date,
            'tme_am_in' => $request->tme_am_in,
            'tme_am_out' => $request->tme_am_out,
            'tme_pm_in' => $request->tme_pm_in,
            'tme_pm_out' => $request->tme_pm_out,
            'tme_ot_in' => $request->tme_ot_in,
            'tme_ot_out' => $request->tme_ot_out,
        ]);

        return back()->with('success', 'DTR record added successfully.');
    }

    public function showUserDtr($id)
    {
        $user = DB::table('users')
            ->leftJoin('schoolaccounts', 'users.accID', '=', 'schoolaccounts.accID')
            ->select('users.*', 'schoolaccounts.accName')
            ->where('usrID', $id)
            ->first();

        if (!$user)
            abort(404, 'User not found');

        $dtrs = DB::table('dtr_sams_card')
            ->where('emp_id', $id)
            ->orderBy('tme_date', 'desc')
            ->get();

        $total_reg = $dtrs->sum('tme_reg_total');
        $total_ot = $dtrs->sum('tme_ot_total');

        return view('user_dtr', compact('user', 'dtrs', 'total_reg', 'total_ot'));
    }

    public function printableDtr($id)
    {
        $user = DB::table('users')
            ->leftJoin('schoolaccounts', 'users.accID', '=', 'schoolaccounts.accID')
            ->select('users.*', 'schoolaccounts.accName', DB::raw("CONCAT(users.usrFirstName, ' ', users.usrLastName) as full_name"))
            ->where('usrID', $id)
            ->first();

        if (!$user)
            abort(404, 'User not found');

        $dtrs = DB::table('dtr_sams_card')
            ->where('emp_id', $id)
            ->select(
                DB::raw('tme_date as date'),
                DB::raw('TIME_FORMAT(tme_am_in, "%h:%i %p") as time_in_am'),
                DB::raw('TIME_FORMAT(tme_am_out, "%h:%i %p") as time_out_am'),
                DB::raw('TIME_FORMAT(tme_pm_in, "%h:%i %p") as time_in_pm'),
                DB::raw('TIME_FORMAT(tme_pm_out, "%h:%i %p") as time_out_pm'),
                'tme_reg_total as total_hours'
            )
            ->orderBy('tme_date', 'desc')
            ->get();

        return view('record', compact('user', 'dtrs'));
    }

    public function updateRemark(Request $request, $id)
    {
        $request->validate([
            'tme_id' => 'required|integer',
            'tme_remarks' => 'nullable|string|max:255',
            'tme_photo' => 'nullable|image|max:2048',
        ]);

        if (session('accID') != $id || in_array(session('typ_id'), [1, 2])) {
            return back()->with('error', 'Unauthorized access.');
        }

        $latest = DB::table('dtr_sams_card')
            ->where('emp_id', $id)
            ->orderBy('tme_date', 'desc')
            ->first();

        if (!$latest) {
            return back()->with('error', 'No DTR record found to update.');
        }

        $updateData = ['tme_remarks' => $request->tme_remarks];

        if ($request->hasFile('tme_photo')) {
            $photo = $request->file('tme_photo');
            $filename = 'user_' . $id . '_' . $latest->tme_id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/dtr'), $filename);
            $updateData['tme_photo'] = $filename;
        }

        DB::table('dtr_sams_card')
            ->where('tme_id', $latest->tme_id)
            ->update($updateData);

        return back()->with('success', 'Remark updated successfully.');
    }
}
