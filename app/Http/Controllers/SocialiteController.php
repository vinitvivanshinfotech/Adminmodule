<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleredirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackgoogle()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('user_id', $user->id)->first();
            if ($finduser == null) {
                $newuser = User::create([
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'avatar' => $user->avatar,
                ]);
                Auth::login($newuser);
                return redirect('dashboard');
            } else {
                Auth::login($finduser);
                return redirect('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function gitredirect()
    {
        return Socialite::driver('github')->redirect();

    }
    public function callbackgit()
    {
        try {

            $user = Socialite::driver('github')->user();
            $finduser = User::where('user_id', $user->id)->first();
            if ($finduser == null) {
                $newuser = User::create([
                    'user_id' => $user->id,
                    'name' => $user->nickname,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                ]);
                Auth::login($newuser);
                return redirect('dashboard');
            } else {
                Auth::login($finduser);
                return redirect('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
