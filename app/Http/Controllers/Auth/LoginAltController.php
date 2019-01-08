<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginAlt;

class LoginAltController extends Controller
{

    /**
     * Logueja l'usuari a l'applicació
     * 
     */
    public function login(LoginAlt $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        if (!$user) return redirect('/login');
               
        if (!Hash::check($user->password, Hash::make($request->password))) return redirect('login');

        Auth::login($user);

        return redirect('/home');
    }
}
