<?php

namespace App\Http\Controllers\Api;


use App\Log;
use App\Events\TaskUncompleted;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Events\TaskCompleted;

class CompletedTasksController
{
    public function destroy(Request $request, Task $task)
    {
        $task->complete(false);
        $task->save();

        event(new TaskUncompleted($task));

//        // EXEMPLE COM NO FER
//        Log::create([
//            'text' => "S'ha marcat com a pendent la tasca 'comprar pa'",
//            'time' => Carbon::now(),
//            'action_type'=> 'descompletar',
//            'module_type' => 'Tasques',
//            'icon' => 'lock_open',
//            'color' => 'primary',
//            'user_id' => $request->user()->id,
//            'loggable_id' => $task->id,
//            'loggable_type' => Task::class,
//            'old_value' => true,
//            'new_value' => false
//        ]);
//
//
//        Mail::to($request->user())
//
//            ->send(new TaskUncompleted($task, $request->user()));
        return $task->completed ? "Completada" : "Pendent";
    }

    public function store(Request $request, Task $task)
    {
        $task->complete();
        $task->save();

        event(new TaskCompleted($task));

        return $task->completed ? "Completada" : "Pendent";
    }
}
