<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{ 
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Index', [
            'permissions'=>Auth::user()->permissions
        ]);
    }
}
