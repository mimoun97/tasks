<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\TasquesShow;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TasquesIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TasquesController extends Controller
{

    private $usersUri = '/api/v1/user/tasks';
    private $adminUri = '/api/v1/tasks';

    public function index(TasquesIndex $request)
    {
        $tasks = Auth::user()->can('tasks.manage')  ?
            Task::with(['user', 'tags'])->orderBy('created_at', 'desc')->get() : $request->user()->tasks;

        $tasks = map_collection($tasks);

        $uri = Auth::user()->can('tasks.manage') ? $this->adminUri : $this->usersUri;

        $users = Cache::remember(User::USERS_CACHE_KEY, '10', function () {
            return User::with(['roles', 'permissions'])->orderBy('name')->get();
        });
        $tags = Cache::remember(Tag::TAGS_CACHE_KEY, '10', function () {
            return map_collection(Tag::orderBy('created_at', 'desc')->get());
        });

        return view('tasques', compact('tasks', 'users', 'uri', 'tags'));
    }

    public function show(TasquesShow $request)
    {
        $uri = Auth::user()->can('tasks.manage') ? $this->adminUri : $this->usersUri;

        $task = Task::findOrFail($request->id);
        $task->map();

        $users = User::with(['roles', 'permissions'])->orderBy('name')->get();

        return view('tasques_show', compact('task', 'users', 'uri'));
    }
}
