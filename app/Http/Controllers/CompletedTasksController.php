<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;


class CompletedTasksController extends Controller
{
    public function store(Task $task)
    {
        $task->complete();

        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $task->incomplete();

        return redirect()->back();
    }
}
