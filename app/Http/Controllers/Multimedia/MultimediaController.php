<?php

namespace App\Http\Controllers\Multimedia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MultimediaController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('multimedia.index');
    }
}
