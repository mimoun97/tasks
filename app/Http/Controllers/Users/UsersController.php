<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = map_collection(User::all());
        return view('users.index', compact('users'));
    }
}
