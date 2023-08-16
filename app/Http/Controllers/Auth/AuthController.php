<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    
    public function redirectToProvider(String $service)
    {
        return Socialite::driver($service)->redirect();
    }
    
    
    public function handleProviderCallback(String $service)
    {
        $userData = Socialite::driver($service)->stateless()->user();
 
        $user = User::firstOrCreate([
           'email' => $userData->email,
        ], [
            'name' => $userData->name,
        ]);
     
        Auth::login($user);
     
        return redirect('/')->with('Prihlásenie prebehlo úspešne.');
    }


}
