<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->with(['hd' => 'ku.th'])->redirect();
    }


    public function callback()
    {
        try {
            
        
            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where('email', $googleUser->email)->first();
            

            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->password = md5(rand(1,10000));
                $user->type = 'student';
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/');
        } 
        catch (Exception $e) {
            return 'error';
        }
    }
}
