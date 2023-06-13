<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;
use App\Http\Requests\SlideRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


class SlideController extends Controller
{
    
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Slides/Index', [
            'slides'=>Slide::orderBy('position', 'DESC')->get()
        ]);
    }


    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Slides/Create', [
            'slide'=>new Slide()
        ]);
    }

    public function store(SlideRequest $request): RedirectResponse
    {

        $slide = Slide::create($request->only(['title', 'description', 'link', 'position', 'active']));
        if ($request->image) {
            $data['image'] = $request->file('image')->store('slides');
            $slide->update($data);
        }
        
        return redirect()->route('admin.slide.edit', ['slide'=>$slide->id])->with('succeed', 'Slide bol vytvorený.');
    }

    public function edit(Slide $slide)
    {
        return Inertia::render('Admin/Slides/Edit', [
            'slide'=>$slide
        ]);
    }


    public function update(SlideRequest $request, Slide $slide): RedirectResponse
    {
        $data = $request->only(['title', 'description', 'link', 'image', 'position', 'active']);
        if ($request->image && $request->image->isValid()) {
            $image_path = $request->image->store('images/slides/');
            $data = array_merge($data, ['image'=>$image_path]);
        }
        $slide->update($data);
        return redirect()->route('admin.slide.edit', ['slide'=>$slide->id])->with('succeed', 'Slide bol vytvorený.');
    }


    public function delete(Slide $slide): RedirectResponse
    {
        $slide->delete();
        return redirect()->route('admin.slides')->with('succeed', 'Slide bol vymazaný.');
    }

}
