<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;

class SocialController extends Controller
{
    //
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
       return Socialite::driver('facebook')->redirect();;
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
       	$userSocial = Socialite::driver('facebook')->user();
        $findUser = User::where('remember_token',$userSocial->id)->orWhere('email',$userSocial->email)->first();
        if($findUser)
        {
            Auth::login($findUser);
            return redirect()->route('home')->with('status','Successfully Login');
        }
        else
        {
            $user = new User();
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
			$user->remember_token = $userSocial->id;
            $user->password = bcrypt('password');
            $user->save();
            Auth::login($user);
            return redirect()->route('home')->with('status','Successfully Registered');
        }
    }
}
