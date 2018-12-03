<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasquesIndex;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasquesController extends Controller
{
    public function index(TasquesIndex $request)
    {
        //TODO
        if (Auth::user()->isSuperAdmin() || Auth::user()->hasRole('TaskManager')) {
            $tasks =  map_collection(Task::all());
        } else {
            $tasks = map_collection($request->user()->tasks);
        }



        $users = User::orderBy('name')->get();
        return view('tasques',compact('tasks','users'));
    }
}
