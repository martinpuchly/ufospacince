<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;
use App\Models\Post;

class HomeController extends Controller
{
   
    public function index(): InertiaResponse
    {
        return Inertia::render('Home/Index', [
            'slides'=> Slide::active()->orderBy('position', 'ASC')->get(),
            'posts' => Post::orderBy('published_at', 'DESC')->with(['user' => function ($query) {
                                                                $query->select('id', 'name');
                                                            }])
                                                            ->publish()
                                                            ->take(2)->get()
        ]);
    }


}
