<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;

class HomeController extends Controller
{
   
    public function index(): InertiaResponse
    {
        return Inertia::render('Home/Index', [
            'slides'=> Slide::all()
        ]);
    }


}
