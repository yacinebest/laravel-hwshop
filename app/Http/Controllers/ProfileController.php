<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.edit',compact('user'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->all());
        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->update(['password' => bcrypt($request->get('password')) ]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }


    public function upload(Request $request)
    {
        $file = $request->file('avatar');
        $file->store("public/uploads/avatars");
        $user = User::findOrFail($request->user_id);
        $user->avatar = $file->hashName();
        $user->save();
        return response()->json($user->avatar);

    }
}
