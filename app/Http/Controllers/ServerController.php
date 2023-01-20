<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Server;
use App\Models\Member;
use App\Models\Channel;
use App\Models\Role;
use App\Models\Members_Roles;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::select('id', 'creator_id', 'name', 'image')->get();

        $members = Member::select(['id', 'user_id', 'server_id'])
                        ->where('user_id', Auth::user()->id)->get();
        
        $yourServers = [];

        foreach($members as $member)
        {
            array_push($yourServers, $member->server_id);
        }

        $currently_servers = $servers->whereIn('id', $yourServers);

        return view('dashboard', compact('servers', 'currently_servers', 'members'));
    }

    public function show($id)
    {
        $server = Server::find($id);

        $channels = Channel::where('server_id', '=', $server->id)->get();

        return redirect()->route('channel.show', [$server->id, $channels->first()->id]);
    }

    public function create()
    {
        return view('server.create');
    }

    public function store(Request $request)
    {
        $server = new Server;
        $server->name = $request->input('name');
        $server->image = $request->input('image');
        $server->creator_id = Auth::user()->id;
        $server->save();

        $member = new Member;
        $member->user_id = Auth::user()->id;
        $member->server_id = $server->id;
        $member->save();

        $channel = new Channel;
        $channel->server_id = $server->id;
        $channel->name = 'General';
        $channel->save();

        $ownerRole = new Role;
        $ownerRole->server_id = $server->id;
        $ownerRole->name = 'Owner';
        $ownerRole->color = '#ffff77';
        $ownerRole->save();

        $memberRole = new Role;
        $memberRole->server_id = $server->id;
        $memberRole->name = 'Member';
        $memberRole->color = '#d0d0d0';
        $memberRole->save();

        $member_role = new Members_Roles;
        $member_role->member_id = $member->id;
        $member_role->role_id = $ownerRole->id;
        $member_role->save();

        return redirect()->route('server.show', $server->id);
    }

    public function config($id)
    {
        return view('server.config');
    }
}
