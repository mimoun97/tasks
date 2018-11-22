<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegularUsersController extends Controller
{

    public function index(Request $request)
    {
        //return User::orderBy('created_at')->get();

        return map_collection(User::regular()->get()); //scopes= àmbits
    }



}
