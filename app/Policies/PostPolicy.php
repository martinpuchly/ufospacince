<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function index(User $user): bool|Response
    {
        if($user->hasPermission('posts')){
            return true;
        }
        return abort(403);
    }

    public function create(User $user): bool|Response
    {
        if($user->hasPermission('post-add')){
            return true;
        }
        return abort(403);
    }

    public function edit(User $user): bool|Response
    {
        if($user->hasPermission('post-edit')){
            return true;
        }
        return abort(403);
    }



    public function delete(User $user): bool|Response
    {
        if($user->hasPermission('post-delete')){
            return true;
        }
        return abort(403);
    }

    public function destroy(User $user): bool|Response
    {
        if($user->hasPermission('post-destroy')){
            return true;
        }
        return abort(403);
    }

    public function restore(User $user): bool|Response
    {
        if($user->hasPermission('post-restore')){
            return true;
        }
        return abort(403);
    }
}
