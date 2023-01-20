<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Server;
use App\Models\User;
use App\Models\Member;
use App\Models\Channel;
use App\Models\Message;
use App\Models\Role;
use App\Models\Members_Roles;

class ChannelController extends Controller
{
    public function create($server)
    {
        $server = Server::find($server);

        if ($server->creator_id != Auth::user()->id)
        {
            return redirect()->route('server.show', $server->id);
        }

        $member = Member::where('user_id', Auth::user()->id)
                        ->where('server_id', $server->id)
                        ->first();
                    
        if ($member == null)
        {
            return redirect()->route('dashboard');
        }

        $servers = Server::select('id', 'creator_id', 'name', 'image')->get();

        $members = Member::select(['id', 'user_id', 'server_id'])
                        ->where('user_id', Auth::user()->id)->get();
        
        $yourServers = [];

        foreach($members as $member1)
        {
            array_push($yourServers, $member1->server_id);
        }

        $currently_servers = $servers->whereIn('id', $yourServers);
        
        $channels = Channel::where('server_id', '=', $server->id)->get();

        $members = Member::select(['id', 'user_id', 'server_id'])
                        ->where('server_id', '=', $server->id)
                        ->get();

        $usersIn = [];

        foreach($members as $member1)
        {
            array_push($usersIn, $member1->user_id);
        }

        $users = User::whereIn('id', $usersIn)->get();

        $roles = Role::where('server_id', '=', $server->id)->get();

        $members_roles = Members_Roles::whereIn('role_id', $roles->pluck('id')->toArray())->get();

        return view('channel.create', compact('members_roles', 'roles', 'currently_servers','server', 'channels', 'members', 'users'));
    }

    public function show($server, $channel)
    {
        $server = Server::find($server);

        $member = Member::where('user_id', Auth::user()->id)
                        ->where('server_id', $server->id)
                        ->first();
                    
        if ($member == null)
        {
            return redirect()->route('dashboard');
        }

        $servers = Server::select('id', 'creator_id', 'name', 'image')->get();

        $members = Member::select(['id', 'user_id', 'server_id'])
                        ->where('user_id', Auth::user()->id)->get();
        
        $yourServers = [];

        foreach($members as $member1)
        {
            array_push($yourServers, $member1->server_id);
        }

        $currently_servers = $servers->whereIn('id', $yourServers);
        
        $channels = Channel::where('server_id', '=', $server->id)->get();

        $members = Member::select(['id', 'user_id', 'server_id'])
                        ->where('server_id', '=', $server->id)
                        ->get();

        $usersIn = [];

        foreach($members as $member1)
        {
            array_push($usersIn, $member1->user_id);
        }

        $users = User::whereIn('id', $usersIn)->get();

        $roles = Role::where('server_id', '=', $server->id)->get();

        $members_roles = Members_Roles::whereIn('role_id', $roles->pluck('id')->toArray())->get();

        $messages = Message::where('channel_id', '=', $channel)->get();

        return view('channel.show', compact('messages', 'members_roles', 'roles', 'currently_servers', 'channel', 'server', 'channels', 'members', 'users'));
    }

    public function store(Request $request, $id)
    {
        $channel = new Channel;
        $channel->server_id = $id;
        $channel->name = $request->input('name');
        $channel->save();

        return redirect()->route('server.show', $id);
    }
}
