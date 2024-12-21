<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\SocialFacebookAccountService;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class SocialAuthFacebookController extends Controller
{
    /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect()->to('/');
            }else{
                $username = str_replace(' ', '', $user->name);
                $createUser = User::create([
                    'name' => $user->name,
                    'username' => $username,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($createUser);
                return redirect()->to('/');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
