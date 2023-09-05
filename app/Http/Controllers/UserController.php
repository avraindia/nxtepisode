<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserDetails;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {
        return view('pages.frontend.register');
    }

    public function submit_register_form(Request $request){
        if (User::where('email', '=', $request->user_email)->count() > 0) {
            return response()->json([
                'resp'=> 0, 
                'msg' => 'Email already registered.',
            ]);
        }else{
            $user_name = $request->first_name.' '.$request->last_name;
            $input['email'] = $request->user_email;
            $input['name'] = $user_name;
            $input['password'] = bcrypt($request->psw); 
            $new_user = User::create($input); 

            $user_id = $new_user->id;

            User::where('id', $user_id)->update([
                'role_id' => 3
            ]);

            $userDetailsObject = new UserDetails();
            $userDetailsObject->user_id = $user_id;
            $userDetailsObject->full_name = $user_name;
            $userDetailsObject->email = $request->user_email;
            $userDetailsObject->phone_number = $request->user_phone;
            $userDetailsObject->gender = $request->user_gender;
            $userDetailsObject->save();

            return response()->json([
                'resp'=> 0, 
                'msg' => 'User registered successfully.',
            ]);
        }
    }

    public function frontlogin(){
        return view('pages.frontend.login');
    }

    public function submit_login_form(Request $request){
        $role_obj = 
        User::select([
            'roles.name'
        ])
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->where('users.email', $request->user_email)
        ->where('roles.name', 'frontend_user')
        ->limit(1)
        ->first();

        if(!$role_obj){
            return response()->json([
                'resp'=> 0, 
                'msg' => 'Invalid Credentials',
            ]);
        }
        
        if(auth()->attempt(array('email' => $request->user_email, 'password' => $request->psw)))
        {
            return response()->json([
                'resp'=> 1, 
                'msg' => 'Login successfull.',
            ]);
        }else{
            return response()->json([
                'resp'=> 0, 
                'msg' => 'Invalid Credentials',
            ]);
        }
    }
}
