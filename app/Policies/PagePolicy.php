<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Http\Response;


class PagePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function index(User $user): bool|Response
    {
        if($user->hasPermission('pages')){
            return true;
        }
        return abort(403);
    }

    public function create(User $user): bool|Response
    {
        if($user->hasPermission('page-add')){
            return true;
        }
        return abort(403);
    }

    public function edit(User $user): bool|Response
    {
        if($user->hasPermission('page-edit')){
            return true;
        }
        return abort(403);
    }



    public function delete(User $user): bool|Response
    {
        if($user->hasPermission('page-delete')){
            return true;
        }
        return abort(403);
    }

    public function destroy(User $user): bool|Response
    {
        if($user->hasPermission('page-destroy')){
            return true;
        }
        return abort(403);
    }

    public function restore(User $user): bool|Response
    {
        if($user->hasPermission('page-restore')){
            return true;
        }
        return abort(403);
    }
}
