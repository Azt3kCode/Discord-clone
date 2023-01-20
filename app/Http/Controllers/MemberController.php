<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Members_Roles;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function store($id)
    {
        $member = new Member;
        $member->user_id = Auth::user()->id;
        $member->server_id = $id;
        $member->save();

        $assignRole = new Members_Roles;
        $assignRole->member_id = $member->id;

        $role = Role::where('server_id', '=',$member->server_id)
                    ->where('name', '=','Member')
                    ->first();

        $assignRole->role_id = $role->id;
        $assignRole->save();

        return redirect()->route('server.show', $id);
    }
}
