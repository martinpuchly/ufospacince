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



    public function create(User $user): bool | Response
    {
        if($user->hasPermission('player-add')){
            return true;
        }
        return abort(403);
    }


    public function edit(User $user, Player $player=null): bool | Response
    {
        if($user->hasPermission('player-edit') && $player!=null){
            return true;
        }
        if($user->player() && $player==null){
            return true;
        }

        return abort(403);
    }


    public function delete(User $user, Player $player=null): bool | Response
    {
        if($user->hasPermission('player-delete') && $player){
            return true;
        }
        if($user->player() && $player==null){
            return true;
        }

        return abort(403);
    }

}
