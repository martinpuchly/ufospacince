<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Requests\GroupRequest;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    //zoznam skupín a formulár na pridanie skupiny
    public function index(){
        return Inertia::render('Admin/Groups/Index', [
            'groups' => Group::all()
        ]);
    }

    //pridanie skupiny
    public function store(GroupRequest $request){
        $group = Group::create($request->validated());
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola pridaná');
    }


    //upravenie skupiny - form
    public function edit(Group $group){
        return Inertia::render('Admin/Groups/Edit',[
            'group' => $group
        ]);
    }
    //upravenie skupiny
    public function update(GroupRequest $request, Group $group){
        $group->fill($request->validated());
        $group->save();
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola upravená.');
    }

    //vymazanie skupiny
    public function delete(Group $group){
        $group->delete();
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola vymazaná.');
    }

    public function user(User $user){
        return Inertia::render('Admin/Groups/User', [
            'groups' => Group::all(),
            'user' => $user,
            'user_groups' => $user->groups->pluck('id')->toArray()
            
        ]);
    }
    public function userSetGroup(Request $request, User $user){
        DB::table('group_user')->where('user_id', $user->id)->delete();
        foreach($request->user_groups as $group){
            DB::table('group_user')->insert([
                'user_id'=>$user->id,
                'group_id'=>$group
            ]);
        }
        
        return redirect()->route('admin.groups.user', ['user'=>$user])->with('succeed', 'Priradenie do skupín bolo uložené.');
    }

}
