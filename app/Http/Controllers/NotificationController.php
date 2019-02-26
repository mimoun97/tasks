<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\DatabaseNotification;
use App\Http\Requests\NotificationsIndex;

class NotificationController extends Controller
{
    /**
     * NotificationsIndex.
     *
     * @param NotificationsIndex $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(NotificationsIndex $request)
    {
        dd('Hola!');
        $notifications = collect([]);
        $users = collect([]);
        if ($request->user()->can('notifications.index')) {
            $notifications = map_collection(DatabaseNotification::notifications());
            $users = map_simple_collection(User::all());
        }
        $userNotifications = $request->user()->notifications;
        return view('notifications.index', compact('userNotifications', 'notifications', 'users'));
    }
}
