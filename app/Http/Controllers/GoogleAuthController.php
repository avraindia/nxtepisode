<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        try {
            /// Get user details of loggedin google user
            $google_user = Socialite::driver('google')->user();

            /// check if this logged in user already registered in the database
            $user = User::where('google_id', $google_user->getId())->first();

            if(!$user){
                /// if user not exists in the database then we need to create this user
                $input['email'] = $google_user->getEmail();
                $input['name'] = $google_user->getName();
                $new_user = User::create($input); 

                $user_id = $new_user->id;

                User::where('id', $user_id)->update([
                    'role_id' => 3,
                    'google_id' => $google_user->getId()
                ]);

                $userDetailsObject = new UserDetails();
                $userDetailsObject->user_id = $user_id;
                $userDetailsObject->full_name = $google_user->getName();
                $userDetailsObject->email = $google_user->getEmail();
                $userDetailsObject->phone_number = '';
                $userDetailsObject->gender = 'm';
                $userDetailsObject->save();

                Auth::login($new_user);

                return redirect()->route('home');
            }else{
                Auth::login($user);
                return redirect()->route('home');
            }


        } catch (\Throwable $th) {
            dd('Something went wrong'.$th->getMessage());
        }
    }
}
