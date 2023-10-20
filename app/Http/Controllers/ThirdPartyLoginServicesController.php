<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class ThirdPartyLoginServicesController extends Controller
{
    //
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle() {
        try {
            $google_user = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('google_id',$google_user->getId())->first();

            if ($findUser) {
                // Auth::attempt(['email' => $findUser['email'], 'password' => $findUser['password']]);
                Auth::login($findUser);
                return redirect()->route('user#home');
            }else {
                $user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'role' => 'user',
                    'image' => null
                ]);

                // Auth::attempt(['email' => $new_user['email'], 'password' => $new_user['password']]);
                Auth::login($user,true);
                // Auth::loginUsingId($new_user->id);
                return redirect()->route('auth#setPasswordPage',Auth::user()->id);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
