<?php

namespace App\Policies;

use App\Models\Slide;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SlidePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('slides');

    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('slide-add');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermission('slide-edit');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission('slide-delete');

    }


}
