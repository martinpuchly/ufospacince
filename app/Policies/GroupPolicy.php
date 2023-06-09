<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->hasPermission('groups');
    }

    /**
     * Determine whether the user can create models.
     */
    public function setUser(User $user): Response|bool
    {
        return $user->hasPermission('user-groups');
    }

    
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response|bool
    {
        if($user->hasPermission('group-add')){
            return true;
        }
        return abort(403);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): Response|bool
    {
        if($user->hasPermission('group-edit')){
            return true;
        }
        return abort(403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): Response|bool
    {
        if($user->hasPermission('group-delete')){
            return true;
        }
        return abort(403);
    }
}
