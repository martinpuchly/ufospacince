<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{ 
    public function index(): InertiaResponse
    {
        Gate::authorize('is-admin');

        $user_permissions = Auth::user()->id == 1 ? null : Auth::user()->permissions;
        return Inertia::render('Admin/Index', [
            'permission_groups'=>Permission::orderedPerm($user_permissions)
        ]);
    }
}
