<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\HelloNotification;
use App\Http\Requests\Notifications\HelloNotificationStore;

class HelloNotificationsController extends Controller
{


    /**
     * Index.
     *
     * @param HelloNotificationStore $request
     * @return mixed
     */
    public function store(HelloNotificationStore $request)
    {
        //dd("Hola");
        $request->user()->notify(new HelloNotification);
        return response()->json('Notification sent.', 201);
    }
}
