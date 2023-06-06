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
        return redirect()->route('admin.player.edit', ['player'=>$player->id])->with('succeed', 'Hráč bol vytvorený.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player=null)
    {
        if(!$player){
            $player = Auth::user()->player;
        }
        dd($player);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayerRequest $request, Player $player=null)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
