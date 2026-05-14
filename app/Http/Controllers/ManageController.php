<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class ManageController extends Controller
{
    public function users()
    {
    $users = DB::table('users')
        ->join('positions', 'positions.position_id', '=', 'users.position_id')
        ->select('users.*', 'positions.position as user_pos')
        ->where('users.active_flag', 'y')
        ->get();

        $positions = DB::table('positions')
        ->where('delete_flag', 'n')
        ->get();

         $user_types = DB::table('user_types')
        ->where('delete_flag', 'n')
        ->get();

        return view('manage.users.main', compact(
            'users','positions','user_types'
        ));
    }

    public function save_user(Request $request)
{
    $request->validate([
        'first_name'     => 'required',
        'last_name'      => 'required',
        'email'          => 'required|email|unique:users,email',
        'position_id'    => 'required',
        'user_type_id'   => 'required',
        'password'       => 'required|min:6|same:password_confirmation',
    ]);

    DB::table('users')->insert([
        'user_id'      => (string) Str::uuid(),

        'first_name'   => $request->first_name,
        'last_name'    => $request->last_name,
        'initial'      => $request->initial,

        'email'        => $request->email,

        'position_id'  => $request->position_id,
        'user_type_id' => $request->user_type_id,

        'password'     => md5($request->password),

        'active_flag'  => 'y',

        'created_at'   => now(),
        'created_by'   => session('usrUuId'),

    ]);

    return redirect()
        ->back()
        ->with('success', 'User successfully created.');
}

    public function schools()
    {
        $schools = DB::table('schools')
            ->where('delete_flag', 'n')
            ->get();

        return view('manage.schools.main', compact('schools'));
    }

    public function save_school(Request $request)
    {
        $request->validate([
            'school_name' => 'required',
        ]);

       DB::table('schools')->insert([
            'beis_school_no' => $request->beis_school_no,
            'school_name'    => $request->school_name,
            'region'         => $request->region,
            'division_id'    => $request->division_id,
            'district_id'    => $request->district_id,
            'active_flag'    => 'y',
            'created_at'     => now(),
            'created_by'     => session('usrUuId'),

        ]);

        return redirect()->back()->with('success', 'School added successfully.');
    }

    public function migs()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->where('mem_is_good_standing','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.migs',compact('members'));
    }

    public function nominated()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->where('mem_has_nominated','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.nominated',compact('members'));
    }

    public function voted()
    {
        $members = DB::table('members')
        ->join('zones','zones.zone_id','=','members.zone_id')
        ->where('mem_active','=','1')
        ->where('mem_has_voted1','=','1')
        ->orderby('mem_last_name','asc')
        ->orderby('mem_first_name','asc')
        ->get();

        return view('admin.voted',compact('members'));
    }
}
