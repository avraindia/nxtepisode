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
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\OrderStatusModel;
use App\Models\StatusCatalogModel;
use App\Models\OrderDispatchModel;

use App\Mail\ForgetPasswordEmail;
use App\Models\InventoryModel;
use App\Models\VariationModel;
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
        ->where('users.is_active', 1)
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
        $input['password'] = bcrypt($request->user_password); 
        $new_user = User::create($input); 

        $user_id = $new_user->id;

        if($request->is_active == 'on'){
            $is_active = 1;
        }else{
            $is_active = 0;
        }

        User::where('id', $user_id)->update([
            'role_id' => 2,
            'is_active' => $is_active
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
        $user = User::where('id', $id)->get()->first();
        $user_details = UserDetails::where('user_id', $id)->get()->first();
        $permissions = Permission::where('user_id', $id)->pluck('permission')->toArray();
        //dd($permissions);
        return view('pages.admin.user-details', ["user"=>$user, "user_details"=>$user_details, "check_trash"=>$check_trash, "permissions"=>$permissions]);
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

        if($request->is_active == 'on'){
            $is_active = 1;
        }else{
            $is_active = 0;
        }

        User::where('id', $request->user_id)->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'is_active' => $is_active
        ]);

        if($request->user_password){
            $password = bcrypt($request->user_password);
            User::where('id', $request->user_id)->update([
                'password' => $password
            ]);
        }

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

    public function orders(){
        $order_query = 
        OrderModel::select([
            'order.id',
            'order.order_number',
            'order.customer_id',
            'order.final_price',
            'order.payment_type',
            'checkout_address.first_name',
            'checkout_address.last_name',
            'checkout_address.phone_no',
            'users.email',
        ])
        
        ->join('users', 'order.customer_id', '=', 'users.id')
        ->join('checkout_address', 'order.checkout_adress_id', '=', 'checkout_address.id')
        ->join('order_status', 'order_status.order_id', '=', 'order.id')
        ->where('order.payment_status', 1)
        ->orderByDesc("order.id")
        ->groupBy('order.id');
        $order_list = $order_query->paginate(10);
        //dd($order_list);
        
        $status_catalog = StatusCatalogModel::where('is_active', 1)->orderBy('order','asc')->get();

        return view('pages.admin.all-order', ['order_list'=>$order_list, 'status_catalog'=>$status_catalog]);

    }

    public function filtering_order_paginate_result(Request $request){
        $order_query = 
        OrderModel::select([
            'order.id',
            'order.order_number',
            'order.customer_id',
            'order.final_price',
            'order.payment_type',
            'order.created_at',
            'checkout_address.first_name',
            'checkout_address.last_name',
            'checkout_address.phone_no',
            'users.email',
            'order_status.status_catalog_id'
        ])
        ->join('users', 'order.customer_id', '=', 'users.id')
        ->join('checkout_address', 'order.checkout_adress_id', '=', 'checkout_address.id')
        ->join('order_status', 'order_status.order_id', '=', 'order.id')
        ->where('order.payment_status', 1)
        ->orderByDesc("order.id")
        ->groupBy('order.id');

        if(request('search_key')){
            $search_key = request('search_key');
            $order_query->where(function($order_query) use($search_key) {
                $order_query->orWhere('order.order_number', 'like', "%$search_key%");
                $order_query->orWhere('checkout_address.first_name', 'like', "%$search_key%");
                $order_query->orWhere('checkout_address.last_name', 'like', "%$search_key%");
                $order_query->orWhere('checkout_address.phone_no', 'like', "%$search_key%");
                $order_query->orWhere('users.email', 'like', "%$search_key%");
            });
        }

        if(request('from_date') && request('to_date')){
            $from_date = date('Y-m-d H:i:s', strtotime(request('from_date')));
            $to_date = date('Y-m-d H:i:s', strtotime(request('to_date')));

            $order_query->where('order.created_at', '>=', $from_date);
            $order_query->where('order.created_at', '<=', $to_date);
        }

        if(request('status')){
            $order_query->where(DB::raw("(SELECT `status_catalog_id` FROM `order_status` WHERE `order_id`=`order`.`id` order by `id` desc limit 1)"), '=', request('status') );
        }

        $order_list = $order_query->paginate(10);

        return view('pages.admin.order-child', ['order_list' => $order_list]);
    }

    public static function last_status_of_order($id){
        $status_name = 
        OrderStatusModel::select([
            'status_catalog.status_name'
        ])
        ->join('status_catalog', 'status_catalog.id', '=', 'order_status.status_catalog_id')
        ->where('order_status.order_id', $id)
        ->orderByDesc("order_status.id")
        ->limit(1)
        ->first();
        return $status_name;
    }

    public function view_order($id){
        $order_details = 
        OrderModel::select([
            'order.id',
            'order.order_number',
            'order.customer_id',
            'order.final_price',
            'order.payment_type',
            'order.shipping_fee',
            'order.discount',
            'checkout_address.first_name',
            'checkout_address.last_name',
            'checkout_address.phone_no',
            'checkout_address.house_no',
            'checkout_address.street_name',
            'checkout_address.landmark',
            'checkout_address.postal_code',
            'checkout_address.city_district',
            'checkout_address.country',
            'states.name AS state_name',
            'users.email',
        ])
        ->join('users', 'order.customer_id', '=', 'users.id')
        ->join('checkout_address', 'order.checkout_adress_id', '=', 'checkout_address.id')
        ->join('states', 'checkout_address.state', '=', 'states.id')
        //->join('order_status', 'order_status.order_id', '=', 'order.id')
        ->where('order.id', $id)
        ->get()
        ->first();

        $all_order_items_query = 
        OrderItemModel::select([
            'order_item.id',
            'order_item.order_id',
            'order_item.product_id',
            'order_item.product_name',
            'order_item.product_price',
            'order_item.total_price',
            'order_item.quantity',
            'option_values.option_value AS size_name',
        ])
        ->join('option_values', 'option_values.id', '=', 'order_item.size_id')
        ->where('order_item.order_id', $id);

        $all_order_item_num = $all_order_items_query->count();
        $all_order_items = $all_order_items_query->get();

        $status_details = 
        OrderStatusModel::select([
            'order_status.status_catalog_id',
            'status_catalog.status_name',
            'order_status.time AS order_status_time' 
        ])
        ->join('status_catalog', 'status_catalog.id', '=', 'order_status.status_catalog_id')
        ->where('order_status.order_id', $id)
        ->orderBy("order_status.id", 'ASC')
        ->get();

        $dispatch_details = OrderDispatchModel::where('order_id', $id)->get() ->first();

        return view('pages.admin.order-details', ['order_details'=>$order_details, 'item_num'=>$all_order_item_num, 'all_order_items'=>$all_order_items, 'status_details'=>$status_details, 'dispatch_details'=>$dispatch_details]);
    }

    public function order_pack(Request $request){
        $status_id = $this->get_status_id('Packed');

        $statusObject = new OrderStatusModel;
        $statusObject->order_id = $request->order_id;
        $statusObject->status_catalog_id = $status_id;
        $statusObject->save();

        return response()->json([
            'resp'=> 1
        ]);
    }

    public function submit_courier(Request $request){
        $orderResp = $this->push_order_to_shiprocket($request->order_id, $request->length, $request->breadth, $request->height, $request->weight);
        if($orderResp->status_code != 1){
            return response()->json([
                'resp'=> 0,
                'status' => 'Order '.$orderResp->status.' at shipment site.'
            ]);
        }
        
        $dispatchObject = new OrderDispatchModel();
        $dispatchObject->order_id = $request->order_id;
        $dispatchObject->length = $request->length;
        $dispatchObject->breadth = $request->breadth;
        $dispatchObject->height = $request->height;
        $dispatchObject->weight = $request->weight;
        $dispatchObject->shipment_orderId = $orderResp->order_id;
        $dispatchObject->shipment_id = $orderResp->shipment_id;
        $dispatchObject->save();

        $status_id = $this->get_status_id('Shipped');

        $statusObject = new OrderStatusModel;
        $statusObject->order_id = $request->order_id;
        $statusObject->status_catalog_id = $status_id;
        $statusObject->save();

        return response()->json([
            'resp'=> 1
        ]);
    }

    public function generate_shiprocket_tokenID_and_channelId(){
        $login_url = "https://apiv2.shiprocket.in/v1/external/auth/login"; 
        $login_header = array(
            "Content-Type: application/json"
        );
        $login_data = json_encode([
            "email" => env('SHIPROCKET_EMAIL_ID'),
            "password" => env('SHIPROCKET_PASSWORD')
        ]);

        $loginCurl = curl_init();

        curl_setopt($loginCurl, CURLOPT_URL, $login_url);
        curl_setopt($loginCurl, CURLOPT_POST, true);
        curl_setopt($loginCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($loginCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($loginCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($loginCurl, CURLOPT_HTTPHEADER, $login_header);
        curl_setopt($loginCurl, CURLOPT_POSTFIELDS, $login_data);

        $loginResp = curl_exec($loginCurl);
        curl_close($loginCurl);

        $loginResult = json_decode($loginResp);
        $token = $loginResult->token;
        
        $channel_url = "https://apiv2.shiprocket.in/v1/external/channels"; 
        $channel_header = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token.""
        );

        $channelCurl = curl_init();

        curl_setopt($channelCurl, CURLOPT_URL, $channel_url);
        curl_setopt($channelCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($channelCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($channelCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($channelCurl, CURLOPT_HTTPHEADER, $channel_header);
        curl_setopt($channelCurl, CURLOPT_CUSTOMREQUEST, "GET");

        $channelResp = curl_exec($channelCurl);
        curl_close($channelCurl);

        $channelResult = json_decode($channelResp);
        $channelobj = $channelResult->data[0];

        $channelId = $channelobj->id;

        return response()->json([
            'tokenId' => $token,
            'channelId' => $channelId
        ]);
    }

    public function push_order_to_shiprocket($orderId, $length, $breadth, $height, $weight){
        $shiprocketData = $this->generate_shiprocket_tokenID_and_channelId();
        $tokenId = $shiprocketData->getData()->tokenId;
        $channelId = $shiprocketData->getData()->channelId;

        $order_details = OrderModel::where('id', $orderId)->with('user_details')->with('shipping_address')->with('order_items')->get()->first(); 
        $user_details = $order_details->user_details;
        $shipping_address = $order_details->shipping_address;
        $order_items = $order_details->order_items;

        $order_item_arr = array();
        foreach($order_items as $key=>$item){
            $item = array(
                "name" => $item->product_name, 
                "sku" => $item->sku, 
                "units" => $item->quantity, 
                "selling_price" => $item->total_price, 
                "discount" => "", 
                "tax" => $item->gst, 
                "hsn" => "" 
            );
            
            array_push($order_item_arr, $item);
        }

        $order_url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc"; 
        $order_header = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$tokenId.""
        );

        $order_data = json_encode([
            "order_id" => $order_details->order_number, 
            "order_date" => date('Y-m-d H:i:s', strtotime($order_details->created_at)), 
            "pickup_location" => "Primary", 
            "channel_id" => $channelId, 
            "comment" => "NextEpisode Product Order", 
            "billing_customer_name" => $shipping_address->first_name, 
            "billing_last_name" => $shipping_address->last_name, 
            "billing_address" => $shipping_address->house_no.' '.$shipping_address->street_name, 
            "billing_address_2" => $shipping_address->landmark, 
            "billing_city" => $shipping_address->city_district, 
            "billing_pincode" => $shipping_address->postal_code, 
            "billing_state" => $shipping_address->state_name, 
            "billing_country" => $shipping_address->country, 
            "billing_email" => $user_details->email, 
            "billing_phone" => $user_details->phone_number, 
            "shipping_is_billing" => true, 
            "shipping_customer_name" => "", 
            "shipping_last_name" => "", 
            "shipping_address" => "", 
            "shipping_address_2" => "", 
            "shipping_city" => "", 
            "shipping_pincode" => "", 
            "shipping_country" => "", 
            "shipping_state" => "", 
            "shipping_email" => "", 
            "shipping_phone" => "", 
            "order_items" => $order_item_arr, 
            "payment_method" => "Prepaid", 
            "shipping_charges" => $order_details->shipping_fee, 
            "giftwrap_charges" => 0, 
            "transaction_charges" => 0, 
            "total_discount" => $order_details->discount, 
            "sub_total" => $order_details->final_price, 
            "length" => $length, 
            "breadth" => $breadth, 
            "height" => $height, 
            "weight" => $weight 
        ]);

        $orderCurl = curl_init();

        curl_setopt($orderCurl, CURLOPT_URL, $order_url);
        curl_setopt($orderCurl, CURLOPT_POST, true);
        curl_setopt($orderCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($orderCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($orderCurl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($orderCurl, CURLOPT_HTTPHEADER, $order_header);
        curl_setopt($orderCurl, CURLOPT_POSTFIELDS, $order_data);

        $orderResp = curl_exec($orderCurl);
        curl_close($orderCurl);

        $orderResult = json_decode($orderResp);
        return $orderResult;
    }

    public function order_on_way(Request $request){
        $status_id = $this->get_status_id('On the way');

        $statusObject = new OrderStatusModel;
        $statusObject->order_id = $request->order_id;
        $statusObject->status_catalog_id = $status_id;
        $statusObject->save();

        return response()->json([
            'resp'=> 1
        ]);
    }

    public function order_delivered(Request $request){
        $status_id = $this->get_status_id('Delivered');

        $statusObject = new OrderStatusModel;
        $statusObject->order_id = $request->order_id;
        $statusObject->status_catalog_id = $status_id;
        $statusObject->save();

        return response()->json([
            'resp'=> 1
        ]);
    }

    public function cancel_order(Request $request){
        $status_id = $this->get_status_id('Cancelled');

        $statusObject = new OrderStatusModel;
        $statusObject->order_id = $request->order_id;
        $statusObject->status_catalog_id = $status_id;
        $statusObject->save();

        return response()->json([
            'resp'=> 1
        ]);
    }

    public static function get_status_id($status_name){
        $status_obj = StatusCatalogModel::where('status_name', $status_name)->get()->first();
        $status_id = $status_obj->id;
        return $status_id;
    }

}
