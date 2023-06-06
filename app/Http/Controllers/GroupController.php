<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class GroupController extends Controller
{
    //zoznam skupín a formulár na pridanie skupiny
    public function index(): InertiaResponse {
        return Inertia::render('Admin/Groups/Index', [
            'groups' => Group::all()
        ]);
    }

    //pridanie skupiny
    public function store(GroupRequest $request): RedirectResponse{
        $group = Group::create($request->validated());
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola pridaná');
    }


    //upravenie skupiny 
    public function edit(Group $group): InertiaResponse{
        return Inertia::render('Admin/Groups/Edit',[
            'group' => $group
        ]);
    }

    public function update(GroupRequest $request, Group $group): RedirectResponse{
        $group->fill($request->validated());
        $group->save();
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola upravená.');
    }

    //vymazanie skupiny
    public function delete(Group $group): RedirectResponse {
        $group->delete();
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola vymazaná.');
    }

    public function user(User $user): InertiaResponse{
        return Inertia::render('Admin/Groups/User', [
            'groups' => Group::all(),
            'user' => $user,
            'user_groups' => $user->groups->pluck('id')->toArray()
            
        ]);
    }
    public function userSetGroup(Request $request, User $user): RedirectResponse{
        $user->groups()->sync($request->user_groups);
        return redirect()->route('admin.groups.user', ['user'=>$user])->with('succeed', 'Priradenie do skupín bolo uložené.');
    }

}
