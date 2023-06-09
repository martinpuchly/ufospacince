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

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        return Inertia::render('Admin/Players/Index', [
            'players'=> Player::orderBy('last_name')->paginate(20)
        ]);
    }


    /**
     * Display players 
    */

    public function index()
    {
        //
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
    public function store(PlayerRequest $request, User $user=null)
    {
        $player = Player::create(array_merge($request->only(['first_name', 'last_name', 'slug']), ['user_id'=>$user ? $user->id : null]));
        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol vytvorený.');
    }

    /**
     * Display the specified resource.
     */
    public function show($player_slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player=null)
    {

        $player = !$player ? Auth::user()->player : $player;    //ak nie je definovaný hráč, pôjde sa editovať profil hráča prihláseného užívateľa
        return Inertia::render('Player/Edit', [
            'player'=>$player,
            'show_options'=>Player::SHOW_OPTIONS,
            'user_name' => $player->user ? $player->user->name : '-- nepripojený --'
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayerRequest $request, Player $player=null)
    {
        $player = !$player ? Auth::user()->player : $player;    //ak nie je definovaný hráč, pôjde sa editovať profil hráča prihláseného užívateľa
        $player->fill($request->only([
            'nickname', 'birth_date', 'shirt_number', 'photo', 'about', 
            'show_first_name', 'show_last_name', 'show_nickname', 'show_birth_date', 
            'show_shirt_number', 'show_photo', 'show_about', 'show_user', 'user_id', 'show_player', 'slug'
        ]));
        if($player->first_name)
        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol upravený.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Player $player=null)
    {
        $player = !$player ? Auth::user()->player : $player;
        $player->delete();

        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol vymazaný.');

    }


    public function restore(Player $player)
    {
        $player->restore();
        return redirect()->route('admin.players')->with('succeed', 'Hráč bol trvale vymazaný.');
    }

    public function destroy(Player $player)
    {
        $player->forceDelete();
        return redirect()->route('admin.players')->with('succeed', 'Hráč bol trvale vymazaný.');

    }
}
