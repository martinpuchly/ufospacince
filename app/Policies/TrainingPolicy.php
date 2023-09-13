<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Http\RedirectResponse;


class TrainingPolicy
{

    
    public function viewAny(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('trainings')){
            return true;
        }
        return abort(403);
    }

    public function show(User $user): bool | RedirectResponse
    {
        if($user->player){
            return true;
        }
        return abort(403);
    }
  
    public function create(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('training-add')){
            return true;
        }
        return abort(403);
    }
    
    public function edit(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('training-edit')){
            return true;
        }
        return abort(403);
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('training-destroy')){
            return true;
        }
        return abort(403);
    }

    public function setPresence(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('training-presence')){
            return true;
        }
        return abort(403);
    }

}
