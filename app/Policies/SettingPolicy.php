<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SettingPolicy
{
    
    public function edit(User $user): bool
    {
        if($user->hasPermission('settings')){
            return true;
        }
        return abort(403);
    }


}
