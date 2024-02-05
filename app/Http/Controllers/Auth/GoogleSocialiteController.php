<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle($social) {

        return Socialite::driver($social)->redirect();
    }

    public function handleCallback($social) {

        try {
            $user = Socialite::driver($social)->user();

            $finduser = User::where('social_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);

                return redirect()->route('dashboard');
            } else{

                $newUser = User::create([
                    'first_name'=> $user->first_name ?? $user->name,
                    'last_name'=> $user->last_name ?? $user->name,
                    'password'=> bcrypt('my-google'),
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                ]);

                Auth::login($newUser);

                return redirect()->route('dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
