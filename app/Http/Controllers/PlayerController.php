<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\User;
use App\Http\Requests\PlayerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\PlayerResource;
use Intervention\Image\Facades\Image;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex(): InertiaResponse
    {
        return Inertia::render('Admin/Players/Index', [
            'players'=> Player::withTrashed()->with('user')->orderBy('last_name')->paginate(20)
        ]);
    }


    /**
     * Display players 
    */

    public function index(): InertiaResponse
    {
        return Inertia::render('Players/Index', [
            'players'=> PlayerResource::collection(Player::showable()->get()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user=null): InertiaResponse | RedirectResponse
    {
        if($user && $user->player){
            return redirect()->route('player.edit', ['player'=>$user->player->id])->with('succeed', 'Tento užívateľ už má vytvorený profil hráča.');
        }
        return Inertia::render('Admin/Players/Create', [
            'user'=>$user ? $user : null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request, User $user=null): RedirectResponse
    {
        if ($request->image && $request->image->isValid()) {
            $path = $request->image->store('images/slides/');
        }
        $player = Player::create(array_merge($request->only(['first_name', 'last_name', 'slug']), ['user_id'=>$user ? $user->id : null]));
        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol vytvorený.');
    }

    /**
     * Display the specified resource.
     */
    public function show($player_id): InertiaResponse
    {
        $player = Player::showable()->findOrFail($player_id);

        return Inertia::render('Players/Show', [
            'player'=>new PlayerResource($player)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player=null, Request $request): InertiaResponse
    {
        if($player->id == null){
            $player = Auth::user()->player; 
        }
            //ak nie je definovaný hráč, pôjde sa editovať profil hráča prihláseného užívateľa
        return Inertia::render('Players/Edit', [
            'player'=>$player,
            'show_options'=>Player::SHOW_OPTIONS,
            'user_name' => $player->user ? $player->user->name : '-- nepripojený --',
            'can_set_user' => $request->user()->hasPermission('player-set-user'),
            'users'=>User::select('id' ,'name')->orderBy('name', 'ASC')->get()
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player=null): RedirectResponse
    {
        $player = !$player ? Auth::user()->player : $player;    //ak nie je definovaný hráč, pôjde sa editovať profil hráča prihláseného užívateľa
        $player->fill($request->only([
            'nickname', 'birth_date', 'shirt_number', 'about', 
            'show_first_name', 'show_last_name', 'show_nickname', 'show_birth_date','show_age', 
            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug'
        ]));

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . '.' . $request->photo->extension();
            $image = $request->file('photo');

            $image = Image::make($image->path());
            $image->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('storage/players/' .$fileName));            
            $player->fill(['photo'=>$fileName]);
        }
        $player->save();

        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol upravený.');
    }




    public function setUser(Request $request, Player $player): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'nullable|unique:players,user_id,'.$player->user_id,
        ],
        [
            'user_id.unique'=>'Tento užívateľ už má pridelený hráčsky účet.'
        ]);

        $player->update($validated);
        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráčovi bola priradená registrácia.');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function delete(Player $player=null): RedirectResponse
    {
        $player = !$player ? Auth::user()->player : $player;
        $player->delete();

        if(!$player){
            return redirect()->route('/')->with('succeed', 'Váš hráčky účet bol vymazaný.');
        }
        return back()->with('succeed', 'Hráč bol vymazaný.');

    }


    public function restore($player_id): RedirectResponse
    {
        $player = Player::withTrashed()->findOrFail($player_id);
        $player->restore();
        return back()->with('succeed', 'Hráč bol obnovený.');
    }

    public function destroy($player_id): RedirectResponse
    {
        $player = Player::withTrashed()->findOrFail($player_id);
        $player->forceDelete();
        return back()->with('succeed', 'Hráč bol trvale vymazaný.');

    }


    public function setActive(Request $request): RedirectResponse
    {
        $player = Player::withTrashed()->findOrFail($request->input('player'));
        $player->update([
            'active'=>$player->active == 1 ? 0 : 1
        ]);
        return back()->with('succeed', 'Hráčovi bol upravený stav.'); 
    }
}
