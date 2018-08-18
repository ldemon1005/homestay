<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $data = Socialite::driver($social)->user()->user;

        $user = User::firstOrNew(['fb_id' => $data['id']]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['email']);
        $user->fb_id = $data['id'];

        $user->save();

        auth()->login($user);

//        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
//        auth()->login($user);

        return redirect()->to('/home');
    }
}
