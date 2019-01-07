<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskShow;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Http\Requests\DestroyTask;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{

    public function index(Request $request)
    {
        return map_collection(Task::orderBy('created_at')->get());
    }

    public function show(TaskShow $request, Task $task) // Route Model Binding
    {
        return $task->map();
    }

    public function destroy(DestroyTask $request, Task $task)
    {
          $task->delete();
    }

    public function store(StoreTask $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return $task->map();
    }

    public function update(UpdateTask $request, Task $task)
    {
        if ($request->has('completed')) {
            $task->completed = $request->completed;
        }
        if ($request->has('description')) {
            $task->description = $request->description;
        }
        if ($request->has('name')) {
            $task->name = $request->name;
        }
        $task->save();
        return $task->map();
    }

}
