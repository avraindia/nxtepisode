<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Permission;

use App\Mail\ForgetPasswordEmail;
use Illuminate\Support\Facades\Mail;
use Validator;

class AdminController extends Controller
{
    public function signin()
    {
        return view('pages.admin.signin');
    }

    function adminlogin(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $role_obj = 
        User::select([
            'roles.name'
        ])
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->where('users.email', $request->email)
        ->limit(1)
        ->first();
        
        if($role_obj){
            $role_name = $role_obj->name;
            $role_arr = array('admin', 'custom_user');
            if(!in_array($role_name, $role_arr)){
                return redirect()->back()->with('error', 'Invalid Credentials');
            }
            
        }else{
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    
        if(Auth::guard('webadmin')
               ->attempt($request->only(['email', 'password'])))
        {
            return redirect()
                ->route('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    function adminlogout(){
        Auth::guard('webadmin')
            ->logout();

        return redirect()
            ->route('signin');
    }

    public function forget_password(){
        return view('pages.admin.forget-password');
    }

    public function dashboard(){
        return view('pages.admin.dashboard');
    }

    public function users(){
        $user_query = 
        User::select([
            'users.id',
            'users.name',
            'users.email',
            'users.created_at',
            'user_details.phone_number',
            'user_details.gender',
        ])
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->join('user_details', 'user_details.user_id', '=', 'users.id')
        ->where('roles.name', 'custom_user')
        ->orderByDesc('users.id');

        $users = $user_query->paginate(10);

        return view('pages.admin.users', ["users"=>$users]);
    }

    public function filtering_user_paginate_result(Request $request){

    }

    public function customers(){
        $user_query = 
        User::select([
            'users.id',
            'users.name',
            'users.email',
            'users.created_at',
            'user_details.phone_number',
            'user_details.gender',
        ])
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->join('user_details', 'user_details.user_id', '=', 'users.id')
        ->where('roles.name', 'frontend_user')
        ->orderByDesc('users.id');

        $users = $user_query->paginate(10);

        return view('pages.admin.customers', ["users"=>$users]);
    }

    public function add_user(){
        return view('pages.admin.add-user');
    }

    public function save_user(Request $request){
        if (User::where('email', '=', $request->user_email)->count() > 0) {
            return redirect()->back()->with('error', 'Email already registered.');
        }

        $input['email'] = $request->user_email;
        $input['name'] = $request->user_name;
        $input['password'] = bcrypt('Customer123##'); 
        $new_user = User::create($input); 

        $user_id = $new_user->id;

        User::where('id', $user_id)->update([
            'role_id' => 2
        ]);

        $userDetailsObject = new UserDetails();
        $userDetailsObject->user_id = $user_id;
        $userDetailsObject->full_name = $request->user_name;
        $userDetailsObject->email = $request->user_email;
        $userDetailsObject->phone_number = $request->user_phone;
        $userDetailsObject->gender = $request->user_gender;
        $userDetailsObject->save();

        $user_permission = $request->user_permission;
        foreach($user_permission as $key=>$permission_name){
            $permissionObject = new Permission();
            $permissionObject->user_id = $user_id;
            $permissionObject->permission = $permission_name;
            $permissionObject->save();
        }
        return redirect()->route('users')->with('success', 'User added successfully.');
    }
    
    public function user_details($id){
        $check_trash = User::onlyTrashed()->where('id', $id)->get()->count();
        $user_details = UserDetails::where('user_id', $id)->get()->first();
        $permissions = Permission::where('user_id', $id)->pluck('permission')->toArray();
        //dd($permissions);
        return view('pages.admin.user-details', ["user_details"=>$user_details, "check_trash"=>$check_trash, "permissions"=>$permissions]);
    }

    public function customer_details($id){
        $check_trash = User::onlyTrashed()->where('id', $id)->get()->count();
        $user_details = UserDetails::where('user_id', $id)->get()->first();
        
        return view('pages.admin.customer-details', ["user_details"=>$user_details, "check_trash"=>$check_trash]);
    }

    public function update_user(Request $request){
        if (User::where([['email', '=', $request->user_email],['id', '<>', $request->user_id]])->count() > 0) {
            return redirect()->back()->with('error', 'Email already registered.');
        }

        User::where('id', $request->user_id)->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
        ]);

        UserDetails::where('user_id', $request->user_id)->update([
            'full_name' => $request->user_name,
            'email' => $request->user_email,
            'phone_number' => $request->user_phone,
            'gender' => $request->user_gender,
        ]);

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function change_user_permission(Request $request){
        if($request->is_check == 'yes'){
            $permissionObject = new Permission();
            $permissionObject->user_id = $request->user_id;
            $permissionObject->permission = $request->permission_name;
            $permissionObject->save();
        }

        if($request->is_check == 'no'){
            Permission::where(['user_id'=>$request->user_id, 'permission'=>$request->permission_name])->delete();
        }

        return response()->json([
            'resp'=> 1, 
            'msg' => 'Permission changed.',
        ]);
    }
}
