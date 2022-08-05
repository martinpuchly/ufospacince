<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    // ADMIN
        public function adminIndex(){
            return Inertia::render('Admin/Players/Index', [
                'players'=>Player::with('user')->paginate(15)
            ]);
        }

        public function adminCreate(User $user){
            return Inertia::render('Admin/Players/Create',[
                'user'=>$user,
            ]);
        }
        public function adminStore(PlayerRequest $request, User $user){
            $player = new Player($request->validated());
            $player->status = 1;
            $player->save();
            return redirect()->route('admin.players')->with('succeed', 'Žiadosť o hráčky profil bola poslaná.');
        }

    //USER
        public function create(){
            return Inertia::render('Players/Create',[
                'user'=>auth()->user(),
            ]);
        }

        public function store(PlayerRequest $request){
            $player = Player::create($request->validated());
            return redirect()->route('')->with('succeed', 'Žiadosť o hráčky profil bola poslaná.');
        }

    public function edit(Player $player){

        $player = Auth::user()->player;
        dd($player);
        return Inertia::render('Players/Edit',[
            'player'=>$player
        ]);
    }








}
