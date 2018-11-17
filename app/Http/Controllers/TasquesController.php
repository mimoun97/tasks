<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasquesController extends Controller
{
    public function index()
    {
    	$tasks = Task::all();
        return view ('tasques', compact('tasks'));
    }
}
