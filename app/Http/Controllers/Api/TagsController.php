<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTag;
use App\Http\Requests\TagsIndex;
use App\Http\Requests\UpdateTag;
use App\Http\Requests\TagsDestroy;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        return Tag::all();
    }

    public function show(TagsIndex $request, Tag $tag) // Route Model Binding
    {
        return $tag->map();
    }

    public function destroy(TagsDestroy $request, Tag $tag)
    {
          $tag->delete();
    }

    public function store(StoreTag $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }

    public function update(UpdateTag $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }
}
