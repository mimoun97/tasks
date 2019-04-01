<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GamePadController extends Controller
{

    public function index(Request $request)
    {
        return view('gamepad.index');
    }
}
