<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatIndex;

class ChatController extends Controller
{
    /**
     * Index.
     *
     * @param ChatIndex $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ChatIndex $request)
    {
        $channels = $request->user()->channels;
        //dd($request->user()->channels()->get());
        return view('chat.index', compact('channels'));
    }
}
