<?php

namespace App\Http\Controllers\Api\Chat;

use App\Channel;
use App\ChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatMessages\ChatMessagesIndex;
use App\Http\Requests\ChatMessages\ChatMessagesStore;
use App\Http\Requests\ChatMessages\ChatMessagesDestroy;

class ChatMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChatMessagesIndex $request, Channel $channel)
    {
        return map_collection($channel->messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatMessagesStore $request, Channel $channel)
    {
        $message = ChatMessage::create([
            'text' => $request->text
        ]);
        $channel->addMessage($message);
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatMessagesDestroy $request, Channel $channel, ChatMessage $message)
    {
        $message->delete();
        return $message;
    }
}
