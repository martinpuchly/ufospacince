<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Slide;
use App\Http\Requests\SlideCreateRequest;
use App\Http\Requests\SlideUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function store(SlideCreateRequest $request): RedirectResponse
    {
        $data = $request->only(['title', 'description', 'link', 'position', 'active']);
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->storeAs('public/slides', $fileName);
            
            $data = array_merge($data, ['picture'=>$fileName]);
        }
        DB::table('slides')->increment('position');
        $data['position'] = 1;
        $slide = Slide::create($data);
        return redirect()->route('admin.slide.edit', ['slide'=>$slide->id])->with('succeed', 'Slide bol vytvorený.');
    }

    public function edit(Slide $slide)
    {
        return Inertia::render('Admin/Slides/Edit', [
            'slide'=>$slide
        ]);
    }


    public function update(SlideUpdateRequest $request, Slide $slide): RedirectResponse
    {
        $slide->fill($request->only(['title', 'description', 'link', 'active']));
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $fileName = time() . '.' . $request->picture->extension();
            $request->picture->storeAs('public/slides', $fileName);
            $slide->fill(['picture'=>$fileName]);
        }
        
        $slide->save();
        return redirect()->route('admin.slide.edit', ['slide'=>$slide->id])->with('succeed', 'Slide bol upravený.');
    }


    public function delete(Slide $slide): RedirectResponse
    {
        Storage::delete('slides/'.$slide->picture);

        $slide->delete();
        return redirect()->route('admin.slides')->with('succeed', 'Slide bol vymazaný.');
    }



    public function setActive(Slide $slide): RedirectResponse{
        $slide->active = $slide->active == 1 ? 0 : 1;
        $slide->save();

        $msg = $slide->active == 1 ? 'aktivovaný' : 'deaktivovaný';
        return redirect()->route('admin.slides')->with('succeed', 'Slidu bol '.$msg.'.');
    }

    public function setUpPosition(Slide $slide): RedirectResponse{
        Slide::where('position', $slide->position-1)->increment('position');
        $slide->decrement('position');
        return redirect()->route('admin.slides')->with('succeed', 'Pozícia slidu bola upravená.');

    }

    public function setDownPosition(Slide $slide): RedirectResponse{
        Slide::where('position', $slide->position+1)->decrement('position');
        $slide->increment('position');
        return redirect()->route('admin.slides')->with('succeed', 'Pozícia slidu bola upravená.');

    }

}
