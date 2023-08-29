<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('user.profil.index');
    }

    public function editProfil()
    {
        return view('user.profil.detail');
    }

    public function update(Request $request)
    {
        $request->user()->update(
            $request->all()
        );

        return back()->with('success', 'Profile updated successfully!');
    }


    public function updatePassword()
    {
        return view('user.profil.update-password');
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string',
        ]);
        $auth = Auth::user();

        if (!Hash::check($request->get('current_password'), $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }
}
