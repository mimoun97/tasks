<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        retTag::orderBy('created_at')->get();
    }

    public function show(Request $request, Tag $tag) // Route Model Binding
    {
        return $tag->map();
    }

    public function destroy(Request $request, Tag $tag)
    {
          $task->delete();
    }

    public function store(StoreTask $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $task->map();
    }

    public function update(UpdateTask $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        return $tag->map();
    }
}
