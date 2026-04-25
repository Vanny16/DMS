<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('changePassword');
    }

    /**
     * Change Password (plain text logic, no hashing)
     */
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
}