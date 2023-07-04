<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;
use App\Http\Requests\SlideRequest;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Str;

class SlideController extends Controller
{
    
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Slides/Index', [
            'slides'=>Slide::orderBy('position', 'ASC')->get()
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
        $data = $request->only(['title', 'description', 'link', 'active']);

        if ($request->file('picture')) {
            $filename = Str::random(15).'.'.$request->file('picture')->getClientOriginalExtension();

            $img = Image::make($request->file('picture'));
            $img->save('public/uploads/slides/'.$filename);
            $data["picture"] = $filename;
        }

        Slide::increment('positions');
        $data["position"] = 1;

        $slide = Slide::create($data);
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
        $data = $request->only(['title', 'description', 'link', 'position', 'active']);

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
