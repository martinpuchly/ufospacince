<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;
use App\Models\Post;
use App\Models\Training;

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
                                                            ->take(2)->get(),
            'trainings'=> Training::orderBy('date_time', 'ASC')
                                    ->where('date_time', '>', Date("Y-m-d H:i"))
                                    ->take(3)->get()
        ]);
    }


}
