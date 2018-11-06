<?php

namespace AppTasques\Http\Controllers\Auth;

use AppTasques\Http\Controllers\Controller;
use AppTasques\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterAltController extends Controller
{
    //pubf

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/home');

    }

}
