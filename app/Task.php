<?php

namespace AppTasques;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks');
    }
}
