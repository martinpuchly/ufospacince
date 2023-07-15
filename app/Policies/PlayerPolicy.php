<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Response;
class PlayerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }



    public function adminIndex(User $user): Response|bool
    {
        return $user->hasPermission('admin-players');

    }


    public function create(User $user): bool|Response
    {
        if($user->hasPermission('player-add')){
            return true;
        }
        return abort(403);
    }


    public function edit(User $user, ?Player $player=null): bool|Response
    {
        return true;
        if($user->hasPermission('player-edit') && $player!=null){
            return true;
        }
        if($user->player() && $player==null){
            return true;
        }

        return abort(403);
    }

 
    public function delete(User $user, Player $player=null): bool|Response
    {
        if($user->hasPermission('player-delete') && $player){
            return true;
        }
        if($user->player() && $player==null){
            return true;
        }

        return abort(403);
    }

    public function destroy(User $user): bool|Response
    {
        if($user->hasPermission('player-destroy')){
            return true;
        }
        return abort(403);
    }

    public function restore(User $user): bool|Response
    {
        if($user->hasPermission('player-restore')){
            return true;
        }
        return abort(403);
    }


    public function set_user(User $user): bool|Response
    {
        if($user->hasPermission('player-set-user')){
            return true;
        }
        return abort(403);
    }

}
