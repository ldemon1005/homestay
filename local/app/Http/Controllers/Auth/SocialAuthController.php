<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        dd([
            Socialite::driver($social)->user(), $social
        ]);
//        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
//        auth()->login($user);

        return redirect()->to('/home');
    }
}
