<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagsIndex;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagsIndex $request)
    {
        $tags = map_collection(Tag::all());
        return view('tags', [
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
//        dd(Request::input());
        // Request::
//        https://laravel.com/docs/5.7/requests
        Task::create(request(['name', 'completed']));

        // Retornar a /tasks
        return redirect('/tasks');
    }

    public function destroy(Request $request)
    {
//        dd($request->id);
        $task = Task::findOrFail($request->id);
        $task->delete();
        // Retornar a /tasks
        return redirect()->back();
    }

    public function update(Request $request)
    {
//        dd($request->id);
        // Models -> Eloquent -> ORM (HIBERNATE de Java) Object Relation Model
//        dd(Task::find($request->id));

//        if (!Task::find($request->id)) return response(404,'No he trobat');
        $task = Task::findOrFail($request->id);

        request()->validate([
            'name' => ['required', 'min:4', 'max:25']
        ]);

        $task->name = $request->name;
        //$task->complete($request->has('completed'));
        $request->has('completed') ? $task->complete() : $task->incomplete();
        $task->save();

        return redirect('/tasks');
    }

    public function edit(Request $request)
    {

        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);
//        return view('task_edit',compact('task'));
    }

}
