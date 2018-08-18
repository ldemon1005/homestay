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
        $data = Socialite::driver($social)->user();

        if($social == 'facebook'){
            $data = $data->user;
            $user = User::where('social_id',$data['id'])->orWhere('email',$data['email'])->first();

            if(!$user){
                $user = new User();
            }

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['email']);
            $user->social_id = $data['id'];
            $user->social_type = 1;
        }else if ($social == 'google'){
            $email = $data['emails'][0]['value'];
            $name = $data['displayName'];

            $user = User::where('social_id',$data['id'])->orWhere('email',$email)->first();

            if(!$user){
                $user = new User();
            }

            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($email);
            $user->social_id = $data['id'];
            $user->social_type = 2;
        }else {
            return redirect()->to('/login');
        }

        $user->save();

        auth()->login($user);

        return redirect()->to('/home');
    }
}
