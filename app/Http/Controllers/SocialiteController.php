<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController  extends Controller
{
    public function singin()
    {
        // return Socialite::driver('google')->redirect();
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $find = User::where('user_id', $user->id)->first();
        // dd($user);
        if ($find == null) {
            $newuser = User::create([
                'user_id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'avatar' => $user->avatar,
            ]);
            Auth::login($newuser);
            return redirect('dashboard');
        } else {
            Auth::login($find);
            return redirect('dashboard');
        }
    }

    public function githredirect()
    {
        return Socialite::driver('github')->redirect();

    }
    public function callbackgit()
    {
        // dd(request()->all());
        $user = Socialite::driver('github')->user();
        // dd($user);
        $find = User::where('user_id', $user->id)->first();
        // dd($user);
        if ($find == null) {
            $newuser = User::create([
                'user_id' => $user['id'],
                'name' => $user->nickname,
                'email' => $user['email'],
                'avatar' => $user->avatar,
            ]);
            Auth::login($newuser);
            return redirect('dashboard');
        } else {
            Auth::login($find);
            return redirect('dashboard');
        }
    }
}
