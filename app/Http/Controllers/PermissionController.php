<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Permission;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\DB;


class PermissionController extends Controller
{
    
    public function user(User $user){
        return Inertia::render('Admin/Permissions/User',[
            'user'=> $user,
            'permissions' => Permission::orderedPerm(),
            'user_permissions' => $user->permissions->pluck('id')->toArray()
        ]);
    }

    public function userSave(Request $request, User $user){
        $user->permissions()->sync($request->user_permissions);
        return redirect()->route('admin.permissions.user', $user->id)->with('succeed', 'Povolenia užívateľa '.$user->name.' boli uložené.');
    }


    public function group(Group $group){
        return Inertia::render('Admin/Permissions/Group',[
            'group'=> $group,
            'permissions' => Permission::orderedPerm(),
            'group_permissions' => $group->permissions->pluck('id')->toArray()
        ]);
    }

    public function groupSave(Request $request, Group $group){
        $group->permissions()->sync($request->group_permissions);
        return redirect()->route('admin.permissions.group', $group->id)->with('succeed', 'Povolenia skupiny '.$group->name.' boli uložené.');
    }


}
