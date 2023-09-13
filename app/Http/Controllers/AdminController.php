<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Contact;

class AdminController extends Controller
{ 
    public function index(): InertiaResponse
    {
        Gate::authorize('is-admin');

        $user_permissions_keys = Auth::user()->allPermissions();
        $perms_coll = Permission::where('link_in_admin_menu', 1)->get();

        return Inertia::render('Admin/Index', [
            'permission_groups'=>Permission::orderedPerm($perms_coll->whereIn('key', $user_permissions_keys)),
            'new_msg_num'=>Contact::where('status', 1)->count(),
            'unsolved_msg_num'=>Contact::where('status', 2)->count()
        ]);
    }
}
