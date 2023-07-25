<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;

class ContactPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('contacts')){
            return true;
        }
        return abort(403);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('contact-show')){
            return true;
        }
        return abort(403);
    }

    
    
    /**
     * Determine whether the user can delete the model.
     */
    public function destroy(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('contact-destroy')){
            return true;
        }
        return abort(403);
    }


    public function saveStatus(User $user): bool | RedirectResponse
    {
        if($user->hasPermission('contact-saveStatus')){
            return true;
        }
        return abort(403);
    }

    
}
