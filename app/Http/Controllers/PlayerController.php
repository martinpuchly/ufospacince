<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\User;
use App\Http\Requests\PlayerRequest;
use Illuminate\Support\Facades\Auth;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user = null): InertiaResponse
    {
        return Inertia::render('Admin/Players/Create', [
            'user_id'=>$user ? $user->id : null,
            'username'=>$user ? $user->name : null,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        $player = Player::create($request->only(['first_name', 'last_name', 'slug']));
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
            'show_options'=>Player::SHOW_OPTIONS
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayerRequest $request, Player $player=null)
    {
        $player = !$player ? Auth::user()->player : $player;    //ak nie je definovaný hráč, pôjde sa editovať profil hráča prihláseného užívateľa
        $player->fill($request->all());
        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol upravený.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player, Player $player=null)
    {
        $player = !$player ? Auth::user()->player : $player;
        $player->delete();

        return redirect()->route('player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol upravený.');

    }
}
