<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\CategoryModel;
use App\Models\TypeModel;
use App\Models\OptionModel;
use App\Models\GenderModel;
use App\Models\ThemeModel;
use App\Models\VariationModel;
use App\Models\ProductModel;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {
        return view('pages.frontend.register');
    }

    public function submit_register_form(Request $request){
        if (User::where('email', '=', $request->reg_email)->count() > 0) {
            return response()->json([
                'resp'=> 0, 
                'msg' => 'Email already registered.',
            ]);
        }else{
            $user_name = $request->full_name;
            $input['email'] = $request->reg_email;
            $input['name'] = $user_name;
            $input['password'] = bcrypt($request->new_password); 
            $new_user = User::create($input); 

            $user_id = $new_user->id;

            User::where('id', $user_id)->update([
                'role_id' => 3
            ]);

            $userDetailsObject = new UserDetails();
            $userDetailsObject->user_id = $user_id;
            $userDetailsObject->full_name = $user_name;
            $userDetailsObject->email = $request->reg_email;
            $userDetailsObject->phone_number = $request->user_phone;
            $userDetailsObject->gender = $request->user_gender;
            $userDetailsObject->save();

            return response()->json([
                'resp'=> 1, 
                'msg' => 'User registered successfully.',
            ]);
        }
    }

    public function frontlogin(){
        return view('pages.frontend.login');
    }

    public function frontlogout(){
        Auth::logout();

        return redirect()
            ->route('home');
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

    public function profile(){
        $userId = Auth::id();
        $user = User::where('id', $userId)->get()->first();
        $user_details = UserDetails::where('user_id', $userId)->get()->first();
        
        return view('pages.frontend.profile', ["user"=>$user, "user_details"=>$user_details]);
    }

    public function check_email(Request $request){
        $user_id = $request->user_id;
        $email_address = $request->email_address;

        $user = User::where('email', $email_address)->where('id', '<>', $user_id)->get();
        $user_num = $user->count();

        if($user_num > 0){
            return response()->json([
                'resp'=> false,
                'msg'=> 'Email id already exists.'
            ]);
        }else{
            return response()->json([
                'resp'=> true
            ]);
        }
    }

    public function update_profile(Request $request){
        User::where('id', $request->user_id)->update([
            'name' => $request->full_name,
            'email' => $request->email_address
        ]);

        UserDetails::where('user_id', $request->user_id)->update([
            'full_name' => $request->full_name,
            'email' => $request->email_address,
            'phone_number' => $request->phone_number
        ]);

        if(request()->hasFile('user_image')) { 
            $user_image = $request->file('user_image');

            $filenameWithExt = $user_image->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $user_image->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $user_image->storeAs('public/uploads/profile_image', $fileNameToStore);

            UserDetails::where('user_id', $request->user_id)->update([
                'profile_image' => $fileNameToStore
            ]);
        }

        return redirect()->route('profile')->with(['successmsg' => 'Profile updated successfully.']);
    }
}
