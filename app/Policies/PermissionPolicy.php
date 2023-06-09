<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response|bool
    {
        //
    }


    /**
     * Determine whether the user can create models.
     */
    public function setUser(User $user): Response|bool
    {
        return $user->hasPermission('user-permissions');
    }


    /**
     * Determine whether the user can create models.
     */
    public function setGroup(User $user): Response|bool
    {
        return $user->hasPermission('group-permissions');

    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response|bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): Response|bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): Response|bool
    {
        //
    }

}
