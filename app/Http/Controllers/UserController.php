<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Users;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Users::find(Auth::user()->id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->get('password'))
        ]);

        $user = Users::find(Auth::user()->id);

        return view('users.edit', compact('user'))->with('success', 'Password updated!');
    }
}
