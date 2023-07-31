<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Database\Eloquent\Builder;

class TrainingController extends Controller
{
    
    public function adminIndex(String $q = null): InertiaResponse
    {
        return Inertia::render('Admin/Trainings/Index', [
            'trainings'=>Training::orderBy('date_time', 'DESC')
                                    ->when($q == null, function (Builder $query) {
                                        $query->where('date_time', '>', Date("Y-m-d H:i"));
                                    })
                                    ->paginate(20)
        ]);
    }
    
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Trainings/Create',[
            'training_types' => Training::TYPES,
            'training_places' => Training::PLACES
        ]);
    }

    public function store(StoreTrainingRequest $request): RedirectResponse
    {
        foreach($request->dates as $date){
            Training::create([
                'type'=>$request->type,
                'place'=>$request->place,
                'date_time'=>$date
            ]);
        }
        return redirect()->route('admin.training.add')->with('succeed', 'Tréningy boli pridané.');
    }


    public function edit(Training $training): InertiaResponse
    {
        return Inertia::render('Admin/Trainings/Edit', [
            'training' => $training,
            'training_types' => Training::TYPES,
            'training_places' => Training::PLACES
        ]);
    }


    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $training->update($request->only(['type', 'place', 'description', 'date_time']));
        return back()->with('succeed', 'Tréning bol upravený.');

    }

    public function destroy(Training $training): RedirectResponse
    {
        $training->delete();
        return back()->with('succeed', 'Tréning bol vymazaný.');
    }

}
