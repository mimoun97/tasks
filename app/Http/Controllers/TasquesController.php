<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TasquesIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
//use Barryvdh\Debugbar\Facade as Debugbar;

class TasquesController extends Controller
{
    public function index(TasquesIndex $request)
    {
        $tasks = Auth::user()->can('tasks.manage')  ?
        Task::with(['user', 'tags'])->orderBy('created_at', 'desc')->get() : $request->user()->tasks;
        // $tasks = Cache::remember(Task::TASQUES_CACHE_KEY, '10', function () {
        //     return Auth::user()->can('tasks.manage')  ?
        //      Task::with(['user', 'tags'])->orderBy('created_at', 'desc')->get() : $request->user()->tasks;
        // });

        // $tasks = Auth::user()->can('tasks.manage') ?
        //     Task::with(['user', 'tags'])->orderBy('created_at', 'desc')->get() : $request->user()->tasks;

        //Debugbar::info($tasks);
        

        if (Auth::user()->can('tasks.manage')) {
            $tasks = map_collection($tasks);
            $uri = '/api/v1/tasks';
        } else {
            $tasks = map_collection($tasks);
            $uri = '/api/v1/user/tasks';
        }

        $users = Cache::remember(User::USERS_CACHE_KEY, '10', function () {
            return User::with(['roles', 'permissions'])->orderBy('name')->get();
        });
        $tags = Cache::remember(Tag::TAGS_CACHE_KEY, '10', function () {
            return map_collection(Tag::orderBy('created_at', 'desc')->get());
        });

        return view('tasques', compact('tasks', 'users', 'uri', 'tags'));
    }
}
