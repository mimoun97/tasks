<?php

namespace App\Http\Controllers\Api;

use App\Task;
use function Psy\debug;
use Illuminate\Http\Request;
use App\Events\Tasks\TaskStored;
use App\Http\Requests\StoreTask;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UserTasks\TasksIndex;
use App\Http\Requests\UserTasks\UserTasksIndex;
use App\Http\Requests\UserTasks\UserTaskDestroy;
use App\Http\Requests\UserTasks\UserTasksUpdate;
use App\Http\Requests\UserTasks\UserTasksStore;
use App\Events\Tasks\TaskDestroyed;
use App\Mail\Tasks\TaskUpdated;

class LoggedUserTasksController extends Controller
{
    //TODO requests user
    public function index(UserTasksIndex $request)
    {
        return map_collection($request->user()->tasks);
    }

    public function update(UserTasksUpdate $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description;
        $task->save();

        event(new TaskUpdated($task));

        return $task->map();
    }

    public function destroy(UserTaskDestroy $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->delete();
        event(new TaskDestroyed($task));
    }

    public function store(UserTasksStore $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->description = ($request->has('description')) ? $request->description : null;
        $task->completed = ($request->has('completed')) ? $request->completed : null;
        $task->user_id = Auth::user()->id;
        $task->save();

        event(new TaskStored($task));

        return $task->map();
    }
    //TODO test test test..
}
