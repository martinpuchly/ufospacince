<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use Illuminate\Http\RedirectResponse; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PlayerResource;

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
    
    public function index(String $date = null): InertiaResponse
    {        
        $date_data = explode('-', $date);
        if(count($date_data)!=2 or !checkdate($date_data[1], 1, $date_data[0])){
            $date_data = explode('-', Date("Y-m"));
        }
        $trainings = Training::orderBy('date_time', 'ASC')
                        ->whereYear('date_time', $date_data[0])
                        ->whereMonth('date_time', $date_data[1])
                        ->get();

        $player_trainings_data = DB::table('player_training')
                                            ->select('training_id', 'p_status')
                                            ->where('player_id', Auth::user()->player->id)
                                            ->whereIn('training_id', $trainings->pluck('id')->toArray())
                                            ->get();
        $player_trainings = [];
        foreach($player_trainings_data as $player_trainings_d){
            $player_trainings[$player_trainings_d->training_id] = $player_trainings_d->p_status;
        }     

        return Inertia::render('Trainings/Index', [
            'trainings' =>  $trainings,
            'player_trainings'=> $player_trainings,
            'year'=>$date_data[0],
            'month'=>$date_data[1],
            'month_name'=>Carbon::parse('2023-'.$date_data[1].'-15')->locale('sk')->monthName,
        ]);
    }

    public function show(Training $training): InertiaResponse
    {

        return Inertia::render('Trainings/Show', [
            'training'=>$training,
            'players_num_on'=>DB::table('player_training')->where('training_id', $training->id)->where('p_status', 2)->count(),
            'players_num_off'=>DB::table('player_training')->where('training_id', $training->id)->where('p_status', 1)->count(),
            'players_on'=>PlayerResource::collection($training->playersOn),
            'players_off'=>PlayerResource::collection($training->playersOff),
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



    public function savePresence(Training $training, int $presence){
        if(!$tp = DB::table('player_training')->where('player_id', Auth::user()->player->id)->where('training_id', $training->id)->first()){
            DB::table('player_training')->insert([
                'player_id'=>Auth::user()->player->id,
                'training_id'=>$training->id,
                'p_status'=>$presence
            ]);
        } else{
            DB::table('player_training')
                        ->where('player_id', Auth::user()->player->id)
                        ->where('training_id', $training->id)
                        ->update(['p_status' => $presence]);
        }


        return back()->with('succeed' ,'Účasť na tréningu '.$training->nicer_date_time.' bola uložená.');

    }

}
