<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;
use App\Http\Requests\SlideRequest;
use Illuminate\Http\RedirectResponse;

class SlideController extends Controller
{
    

    public function create(): InertiaResponse
    {
        return Inertia::render('Slider/Create', [
            'slide'=>new Slide()
        ]);
    }

    public function store(SlideRequest $request): RedirectResponse
    {
        $slide = Slide::create($request->only(['title', 'description', 'link', 'image', 'position', 'active']));
        return redirect()->route('admin.slide.edit', ['slide'=>$slide->id])->with('succeed', 'Slide bol vytvorený.');
    }

    public function edit(Slide $slide)
    {
        return Inertia::render('Slider/Edit', [
            'slide'=>$slide
        ]);
    }


    public function update(SlideRequest $request, Slide $slide): RedirectResponse
    {
        $slide->update($request->only(['title', 'description', 'link', 'image', 'position', 'active']));
        return redirect()->route('admin.slide.edit', ['slide'=>$slide->id])->with('succeed', 'Slide bol vytvorený.');
    }


    public function delete(Slide $slide): RedirectResponse
    {
        $slide->delete();
        return redirect()->route('admin.slides')->with('succeed', 'Slide bol vymazaný.');
    }

}
