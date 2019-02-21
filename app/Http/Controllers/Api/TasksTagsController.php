<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TasksTagsUpdate;
use App\Task;

class TasksTagsController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param TasksTagsUpdate $request
     * @param $Task
     * @return void
     */
    public function update(TasksTagsUpdate $request, Task $task)
    {
        //dd($task->name);
        $tags = Task::find($request->tags);
        $task->addTags($tags);
    }
}
