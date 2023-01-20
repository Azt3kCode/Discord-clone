<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Message;
use App\Models\Member;

class MessageController extends Controller
{
    public function store(Request $request, $server, $channel)
    {
        $message = new Message;
        $message->member_id = Member::where('user_id', '=', Auth::user()->id)
                                    ->where('server_id', '=', $server)
                                    ->first()->id;
        $message->channel_id = $channel;
        $message->description = $request->input('description');
        $message->save();

        return redirect()->route('channel.show', [$server, $channel]);
    }
}
