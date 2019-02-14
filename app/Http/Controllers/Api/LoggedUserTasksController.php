<?php

namespace App\Http\Controllers\Api;

use App\Task;
use function Psy\debug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoggedUserTasksController extends Controller
{
    public function index(Request $request)
    {
        return map_collection($request->user()->tasks);
    }

    public function update(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description;
        $task->save();
        return $task;
    }

    public function destroy(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->delete();
    }
    //TODO test test test..
}
