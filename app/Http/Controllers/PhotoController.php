<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoStore;
use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(PhotoStore $request)
    {
        $extension = $request->file('photo')->getClientOriginalExtension();
        $path = $request->file('photo')->storeAs(
            'photos',
            $request->user()->id . '.' . $extension
        );
        $request->file('photo')->storeAs(
            '',
            $request->user()->id . '.' . $extension,
            'google'
        );
        if ($photo = Photo::where('user_id', $request->user()->id)->first()) {
            $photo->url = $path;
            $photo->save();
        } else {
            Photo::create([
                'url' => $path,
                'user_id' => $request->user()->id
            ]);
        }
        return back();
    }
}
