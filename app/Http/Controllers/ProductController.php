<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\VariationModel;
use App\Models\InventoryModel;
use App\Models\ProductgalleryModel;
use App\Models\GenderModel;
use App\Models\OptionModel;
use App\Models\OptionValueModel;
use App\Models\TypeModel;
use App\Models\ThemeModel;
use App\Models\PromoCodeModel;
use App\Models\StateModel;
use App\Models\CheckoutAddressModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\StatusCatalogModel;
use App\Models\OrderStatusModel;
use App\Models\RatingReviewModel;
use App\Models\CashfreeModel;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\ExchangeIssueModel;
use App\Models\ExchangeReasonModel;
use App\Models\ExchangeItemModel;
use App\Models\CollectionProductModel;

class ProductController extends Controller
{
    /**
     * Product admin operarion start
    */
    public function all_products(){
        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();

        $product_query = ProductModel::select([
            'products.id',
            'products.product_title',
            'products.product_mrp',
            'products.status',
            'products.deleted',
            'category.name as category_name',
        ])
        ->join('category', 'category.id', '=', 'products.main_cat_id');

        $products = $product_query->paginate(10);
        
        return view('pages.admin.all-products', ['parent_categories'=>$parent_categories, 'products'=>$products]);
    }

    public function add_product(){
        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();
        $all_themes = ThemeModel::orderBy('id')->get();
        return view('pages.admin.add-product', ['parent_categories'=>$parent_categories, 'all_themes' => $all_themes]);
    }

    public function save_product(Request $request){
        if($request->is_available == 'on'){
            $is_available = 1;
        }else{
            $is_available = 0;
        }
        
        $theme_ids = NULL;
        if($request->theme_id){
            $theme_ids = implode(',', $request->theme_id);
        }

        $productObject = new ProductModel();
        $productObject->product_title = $request->product_name;
        $productObject->main_cat_id = $request->product_main_catergory;
        $productObject->product_mrp = $request->product_mrp;
        $productObject->gst = $request->product_gst;
        $productObject->theme_ids = $theme_ids;
        $productObject->status = $is_available;
        $productObject->save();

        return redirect()->route('all_products')->with(['successmsg' => 'Product added successfully.']);
    }

    public function product_details($id){
        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();
        $genders = GenderModel::orderBy("id", "asc")->get();
        $product_details = ProductModel::where('id', $id)->get()->first();
        $all_themes = ThemeModel::orderBy('id')->get();
        return view('pages.admin.product-details', ['parent_categories'=>$parent_categories, 'genders'=>$genders, 'product_details'=>$product_details, 'all_themes' => $all_themes]);
    }

    public function update_product(Request $request){
        $product_id = $request->product_id;

        if($request->is_available == 'on'){
            $is_available = 1;
        }else{
            $is_available = 0;
        }

        $theme_ids = NULL;
        if($request->theme_id){
            $theme_ids = implode(',', $request->theme_id);
        }

        ProductModel::where('id', $product_id)->update([
            'product_title' => $request->product_name,
            'main_cat_id' => $request->product_main_catergory,
            'product_mrp' => $request->product_mrp,
            'gst' => $request->product_gst,
            'theme_ids' => $theme_ids,
            'status' => $is_available
        ]);

        return redirect()->route('all_products')->with(['successmsg' => 'Product updated successfully.']);
    }

    public function delete_product_image(Request $request){
        ProductgalleryModel::where('id',$request->image_id)->delete();
        return response()->json([
            'status'=> true, 
            'msg' => 'Image deleted successfully'
        ]);
    }

    /**
     * Product admin operarion end
    */

    /**
     * Product frontend operarion start
    */
    public function products(){
        $categories = CategoryModel::all();
        $types = TypeModel::all();
        $options = OptionModel::with('option_values')->get();
        $genders = GenderModel::orderBy("id", "asc")->get();
        $all_themes = ThemeModel::orderBy('id')->get();

        $product_query = VariationModel::select([
            'product_variation.id',
            'product_variation.fitting_title',
            'category.name as cat_name',
            'type.type_name',
            'gender.gender',
            'products.product_mrp'
        ]);
        $product_query
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->with('gallery_images')
        ->where('product_variation.is_active', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products.deleted', '=', 0)
        ->orderBy('product_variation.id' ,'desc');

        if(request('cid')){
            $product_query->where('products.main_cat_id', '=', request('cid'));
        }

        if(request('col')){
            $collectoion_item_id = base64_decode( urldecode( request('col') ) );
            $productIdArr = CollectionProductModel::where("item_id", $collectoion_item_id)->pluck('product_id')->toArray();
            $product_query->whereIn('product_variation.id', $productIdArr);
        }

        $product_count = $product_query->get()->count();
        $all_products = $product_query->paginate(4);
        //dd($all_products);
        return view('pages.frontend.products', ["categories"=>$categories, "types"=>$types, "options"=>$options, "genders"=>$genders, "all_themes"=>$all_themes, "product_count"=>$product_count, "all_products"=>$all_products]);
    }

    public function filtering_paginate_result(Request $request){
        $product_query = VariationModel::select([
            'product_variation.id',
            'product_variation.fitting_title',
            'category.name as cat_name',
            'type.type_name',
            'gender.gender',
            'products.product_mrp'
        ]);
        $product_query
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->with('gallery_images')
        ->where('product_variation.is_active', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products.deleted', '=', 0)
        ->groupBy('product_variation.id');

        if($request->product_cat_ids){
            $product_cat_ids = $request->product_cat_ids;
            $product_query->where(function($product_query) use($product_cat_ids) {
                foreach($product_cat_ids as $product_cat_id) {
                    $product_query->orWhere('products.main_cat_id', '=', "$product_cat_id");
                };
            });
        }

        if($request->product_theme_ids){
            $product_theme_ids = $request->product_theme_ids;
            $product_query->where(function($product_query) use($product_theme_ids) {
                foreach($product_theme_ids as $product_theme_id) {
                    $product_query->orWhere('products.theme_ids', 'like', "%$product_theme_id%");
                };
            });
        }

        if($request->option_value_ids){
            $product_query->join('product_inventory', 'product_inventory.product_id', '=', 'products.id');
            $option_value_ids = $request->option_value_ids;
            $product_query->where(function($product_query) use($option_value_ids) {
                foreach($option_value_ids as $option_value_id) {
                    $product_query->orWhere('product_inventory.option_value_id', '=', "$option_value_id");
                };
            });
        }

        if($request->fitting_type_id){
            $product_query->where('product_variation.fitting_type', '=', $request->fitting_type_id);
        }

        if($request->product_gender_id){
            $product_query->where('product_variation.gender', '=', $request->product_gender_id);
        }

        if($request->product_stock){
            $product_stock = $request->product_stock;
            if($product_stock == 0){
                $product_query->join('product_inventory', 'product_inventory.product_id', '=', 'products.id');
                $product_query->where('product_inventory.current_stock', '=', 0);
            }
            if($product_stock == 1){
                $product_query->join('product_inventory', 'product_inventory.product_id', '=', 'products.id');
                $product_query->where('product_inventory.current_stock', '>', 0);
            }
        }

        $from_price = $request->from_price;
        $to_price = $request->to_price;
        if($to_price>$from_price){
            $product_query->where('products.product_mrp', '>=', $from_price);
            $product_query->where('products.product_mrp', '<=', $to_price);
        }

        if($request->col){
            $collectoion_item_id = base64_decode( urldecode( request('col') ) );
            $productIdArr = CollectionProductModel::where("item_id", $collectoion_item_id)->pluck('product_id')->toArray();
            $product_query->whereIn('product_variation.id', $productIdArr);
        }

        if($request->order_by){
            if($request->order_by == ""){
                $product_query->orderBy('product_variation.id','desc');
            }else{
                $order_by = $request->order_by;
                if($order_by == "price_high_to_low"){
                    $product_query->orderBy('products.product_mrp','desc');
                }

                if($order_by == "price_low_to_high"){
                    $product_query->orderBy('products.product_mrp','asc');
                }

                if($order_by == "newest"){
                    $product_query->orderBy('product_variation.id','desc');
                }

                if($order_by == "oldest"){
                    $product_query->orderBy('product_variation.id','asc');
                }
            }
        }else{
            $product_query->orderBy('product_variation.id','desc');
        }

        $product_count = $product_query->get()->count();
        $all_products = $product_query->paginate(4);
        return view('pages.frontend.products-child', ['product_count' => $product_count, 'all_products' => $all_products, 'is_exchange'=>$request->is_exchange, 'exchange_id'=>$request->exchange_id]);

        /*return response()->json([
            'query'=> $product_query->toSql()
        ]);*/
    }

    public function front_product_details($id){
        $variation_id = base64_decode($id);
        $product_query = VariationModel::select([
            'product_variation.id',
            'product_variation.product_id',
            'product_variation.fitting_title',
            'product_variation.details',
            'product_variation.description',
            'category.name as cat_name',
            'type.type_name',
            'gender.gender',
            'products.product_mrp',
            'products.gst'
        ]);
        $product_query
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->with('gallery_images')
        ->with('chart_images')
        ->where('product_variation.id', '=', $variation_id);
        $product_details = $product_query->get()->first();

        $product_id = $product_details->product_id;

        $size_ids = InventoryModel::where('product_id', $product_id)->pluck('option_value_id')->toArray();
        
        $sizes = OptionValueModel::where('option_id', 2)->get();

        $share_link = route('front_product_details',$id);
        $product_name = $product_details->product_title;
        $shareComponent = \Share::page(
            $share_link,
            $product_name,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()      
        ->reddit();

        $product_review = RatingReviewModel::with('user_details')->where('product_id', $variation_id)->where('status', 1)->offset(0)->limit(4)->orderByDesc('id')->get();
        $review_count = RatingReviewModel::with('user_details')->where('product_id', $variation_id)->where('status', 1)->count();
        $total_rating = RatingReviewModel::where('product_id', $variation_id)->where('status', 1)->sum('rating');
        if($total_rating == 0){
            $avearge_rating = 0;
        }else{
            $avearge_rating = $total_rating/$review_count;
            $avearge_rating = number_format($avearge_rating, 1);
        }

        $user_id = Auth::id();
        $user_review = array();
        if($user_id){
            $user_review = RatingReviewModel::with('user_details')->where('user_id', $user_id)->where('product_id', $variation_id)->get();
        }
        
        //dd($review_count);
        return view('pages.frontend.product-details', ["product_details"=>$product_details, "sizes"=>$sizes, "shareComponent"=>$shareComponent, 'size_ids'=>$size_ids, 'review_count'=>$review_count, 'product_review'=>$product_review, 'user_review'=>$user_review, 'avearge_rating'=>$avearge_rating]);
    }

    public function check_variation_exists(Request $request){
        $product_id = $request->product_id;
        $size_id = $request->size_id;
        $product_gst = $request->product_gst;
        $inventory_price = '0.00';
        $gst_amount = '0.00';
        $sell_price = '0.00';
        $sku = '';

        $inventory_query = InventoryModel::where('product_id', $product_id)->where('option_value_id', $size_id);
        $check_num = $inventory_query->count();
        if($check_num>0){
            $inventory_rec = $inventory_query->get()->first();

            $current_stock = $inventory_rec->current_stock;
            $inventory_price = $inventory_rec->inventory_price;
            $sku = $inventory_rec->sku;
            if($inventory_price != '0.00'){
                $gst_amount = ($inventory_price*$product_gst)/100;
                $gst_amount = round($gst_amount);
                $amount_after_gst = $inventory_price+$gst_amount;
                $sell_price = $amount_after_gst.'.00';
            }
        }

        return response()->json([
            'status'=> true, 
            'num' => $check_num,
            'sku' => $sku,
            'current_stock' => $current_stock,
            'inventory_price' => $inventory_price,
            'gst_amount' => $gst_amount,
            'sell_price' => $sell_price
        ]);
    }

    public function add_to_cart(Request $request){
        \Cart::add([
            'id' => $request->variation_id,
            'name' => $request->product_name,
            'price' => $request->cart_price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'product_id' => $request->product_id,
                'product_image' => $request->product_image,
                'product_price' => $request->product_price,
                'size_id' => $request->size_id,
                'product_sku' => $request->product_sku,
                'product_gst' => $request->product_gst,
                'gst_amount' => $request->gst_amount * $request->quantity,
                'sell_price' => $request->sell_price,
            )
        ]);

        session()->flash('successmsg', 'Product is Added to Cart Successfully !');
        return response()->json([
            'status'=> true, 
            'resp' => 'Product is added to cart successfully.'
        ]);
    }

    public function cart(){
        $cartItems = \Cart::getContent();
        $cartItems = $cartItems->sort();

        //\Cart::remove(6);
        $product_id_arr = array();
        foreach($cartItems as $item){
            $product_id = $item->id;
            array_push($product_id_arr, $product_id);
        }
        $product_ids = implode(',', $product_id_arr);
        $product_query = VariationModel::select([
            'product_variation.id',
            'product_variation.fitting_title',
            'product_variation.fitting_type',
            'category.name as cat_name',
            'products.product_mrp',
            'products.gst'
        ]);
        $product_query
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->with('gallery_images')
        ->with('fitting_name')
        ->where('product_variation.is_active', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products.deleted', '=', 0)
        ->groupBy('product_variation.id');

        if($product_ids != ""){
            $product_query->whereNotIn('product_variation.id', [$product_ids]);
        }
        $product_query->orderBy('product_variation.id','desc');

        $similar_products = $product_query->skip(0)->take(6)->get();

        $sizes = OptionValueModel::where('option_id', 2)->get();
        return view('pages.frontend.cart', ['sizes'=>$sizes, 'cartItems'=>$cartItems, 'similar_products'=>$similar_products]);
    }

    public function updateCart(Request $request)
    {
        $inventory_details = InventoryModel::where('product_id', $request->product_id)->where('option_value_id', $request->size_id)->get()->first();
        $variation_details = VariationModel::where('id', $request->variation_id)->get()->first();
        $product_details = ProductModel::where('id', $request->variation_id)->get()->first();

        $product_price = $inventory_details->inventory_price;
        if($product_price == '0.00'){
            $product_price = $product_details->product_mrp;
        }

        $final_price = $product_price*$request->quantity;

        $current_stock = $inventory_details->current_stock;
        if($current_stock >= $request->quantity){

            \Cart::update(
                $request->variation_id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => $request->quantity
                    ],
                    'price' => $final_price,
                ]
            );
    
            session()->flash('success', 'Cart is Updated Successfully !');
        }else{
            
            $variation_name = $variation_details->fitting_title;
            $msg = 'Cart of "'.$variation_name.'" can not be increased. It is crossed the stock.';
            session()->flash('error', $msg);
        }

        $cartItems = \Cart::getContent();
        $cartItems = $cartItems->sort();
        $sizes = OptionValueModel::where('option_id', 2)->get();
        return view('pages.frontend.cart-child', ['sizes'=>$sizes, 'cartItems'=>$cartItems]);
    }

    public function removeCart(Request $request){
        \Cart::remove($request->id);
        session()->flash('success', 'Product Removed from Cart Successfully !');

        $cartItems = \Cart::getContent();
        $cartItems = $cartItems->sort();
        $sizes = OptionValueModel::where('option_id', 2)->get();
        return view('pages.frontend.cart-child', ['sizes'=>$sizes, 'cartItems'=>$cartItems]);
    }

    public function countCart(){
       $cart_quantity = \Cart::getTotalQuantity();
       return response()->json([
            'status'=> true, 
            'cart_quantity' => $cart_quantity
        ]);
    }

    public function check_promo_code(Request $request){
        $currentTime = Carbon::now();
        $currentDate = $currentTime->toDateString();

        $promocode_exists_obj = PromoCodeModel::
        where([
            ['code', '=', $request->promo_code],
            ['valid_from', '<=', $currentDate],
            ['valid_to', '>=', $currentDate]
        ]);

        $promocode_exists_num = $promocode_exists_obj->count();

        if($promocode_exists_num == 0){
            return response()->json([
                'status'=> false,
                'msg' => 'Promo code is either expired or not exists.'
            ]);
        }else{
            $promocode_details = $promocode_exists_obj->get()->first();

            return response()->json([
                'status'=> true, 
                'promocode_details' => $promocode_details
            ]);
        }
    }

    public function checkout(Request $request){
        if($request->isMethod('POST')){
            $states = StateModel::orderBy("name", "asc")->get();
            $cartItems = \Cart::getContent();
            $cartItems = $cartItems->sort();

            return view('pages.frontend.checkout', ['states'=>$states, 'cartItems'=>$cartItems, 'order_price'=>$request->total_price, 'promo_code_id'=>$request->promocode_id, 'discount'=>$request->discount, 'final_price'=>$request->final_amount]);
        }else{
            return redirect()->route('cart');
        }
    }

    public function save_checkout_address(Request $request){
        $user_id = Auth::id();

        if($request->is_default == 1){
            CheckoutAddressModel::where('user_id', $user_id)->update([
                'default_address' => 0
            ]);
        }

        $addressObject = new CheckoutAddressModel();
        $addressObject->user_id = $user_id;
        $addressObject->first_name = $request->first_name;
        $addressObject->last_name = $request->last_name;
        $addressObject->house_no = $request->house_no;
        $addressObject->street_name = $request->street_name;
        $addressObject->landmark = $request->landmark;
        $addressObject->postal_code = $request->postal_code;
        $addressObject->city_district = $request->city_district;
        $addressObject->phone_no = $request->phone_no;
        $addressObject->country = $request->country;
        $addressObject->state = $request->state;
        $addressObject->default_address = $request->is_default;

        $addressObject->save();


        return response()->json([
            'status'=> true, 
            'msg' => 'Address added successfully.'
        ]);
    }

    public function fetch_saved_address(Request $request){
        $user_id = Auth::id();
        $addresses = CheckoutAddressModel::where('user_id', $user_id)->get();
        $cart_item_count = \Cart::getTotalQuantity();
        
        return response()->json([
            'status'=> true, 
            'addresses' => $addresses,
            'cart_item_count' => $cart_item_count,
        ]);
    }

    public function fetch_address_for_edit(Request $request){
        $address_id = $request->address_id;
        $address_details = CheckoutAddressModel::where('id', $address_id)->get()->first();

        return response()->json([
            'status'=> true, 
            'address_details' => $address_details
        ]);
    }

    public function edit_checkout_address(Request $request){
        $user_id = Auth::id();

        if($request->is_default == 1){
            CheckoutAddressModel::where('user_id', $user_id)->update([
                'default_address' => 0
            ]);
        }

        CheckoutAddressModel::where('id', $request->address_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'house_no' => $request->house_no,
            'street_name' => $request->street_name,
            'landmark' => $request->landmark,
            'postal_code' => $request->postal_code,
            'city_district' => $request->city_district,
            'phone_no' => $request->phone_no,
            'country' => $request->country,
            'state' => $request->state,
            'default_address' => $request->is_default,
        ]);

        return response()->json([
            'status'=> true, 
            'msg' => 'Address updated successfully.'
        ]);

    }

    public function delete_saved_address(Request $request){
        CheckoutAddressModel::where('id',$request->address_id)->delete();
        return response()->json([
            'status'=> true, 
            'msg' => 'Address deleted successfully'
        ]);
    }

    public function payment(Request $request){
        if($request->isMethod('POST')){
            $user_id = Auth::id();
            $cart_item_count = \Cart::getTotalQuantity();
            $addresses = CheckoutAddressModel::where('user_id', $user_id)->get();

            $checked_address = CheckoutAddressModel::where('id', $request->address_id)->get()->first();

            return view('pages.frontend.payment', ['shipping_fee'=>$request->shipping_fee, 'total_price'=>$request->total_price, 'discount'=>$request->discount, 'promocode_id'=>$request->promocode_id, 'final_amount'=>$request->final_amount, 'address_id'=>$request->address_id, 'addresses'=>$addresses, 'cart_item_count' => $cart_item_count, 'checked_address'=>$checked_address]);
        }else{
            return redirect()->route('cart');
        }
    }

    public function order(Request $request){
        /***** Place order start ****/
        $payment_option = $request->payment_option;
        if($payment_option == "online"){
            $payment_type = "Cashfree";
            $payment_status = 0;
        }else{
            $payment_status = 1;
        }

        $user_id = Auth::id();
        $orderObject = new OrderModel();
        $order_number = 'NXTEP'.date('ymdHis').rand(1000,9999);
        $orderObject->order_number = $order_number;
        $orderObject->customer_id = $user_id;
        $orderObject->order_price = $request->total_price;
        $orderObject->promo_code_id = $request->promocode_id;
        $orderObject->checkout_adress_id = $request->address_id;
        $orderObject->discount = $request->discount;
        $orderObject->shipping_fee = $request->shipping_fee;
        $orderObject->payment_type = $payment_type;
        $orderObject->final_price = $request->final_amount;
        $orderObject->payment_status = $payment_status;
        $orderObject->save();
        $order_id = $orderObject->id;

        $cartItems = \Cart::getContent();
        foreach($cartItems as $item){
            $attributes = $item->attributes;

            $orderItemObject = new OrderItemModel();
            $orderItemObject->order_id = $order_id;
            $orderItemObject->product_id = $item->id;
            $orderItemObject->size_id = $attributes->size_id;
            $orderItemObject->product_name = $item->name;
            $orderItemObject->product_price = $attributes->product_price;
            $orderItemObject->total_price = $item->price;
            $orderItemObject->sell_price = $attributes->sell_price;
            $orderItemObject->gst = $attributes->gst_amount;
            $orderItemObject->quantity = $item->quantity;
            $orderItemObject->sku = $attributes->product_sku;

            $orderItemObject->save();
        }

        /***** Place order end ****/

        /***** Payment process start ****/
        if($payment_option == "online"){    
            $address_details = CheckoutAddressModel::where('id', $request->address_id)->get()->first();
            $user_name = $address_details->first_name.' '.$address_details->last_name;
            $phone_no = $address_details->phone_no;
            $amount = $request->final_amount;
            $user_email = auth()->user()->email;
            $customer_id = 'customer_'.$user_id.'_'.rand(111111111,999999999);
            $url = "https://sandbox.cashfree.com/pg/orders"; // sandbox
            //$url = "https://api.cashfree.com/pg/orders"; // production

            $headers = array(
                "Content-Type: application/json",
                "x-api-version: 2022-01-01",
                "x-client-id: ".env('CASHFREE_API_KEY'),
                "x-client-secret: ".env('CASHFREE_API_SECRET')
            );
            
            $data = json_encode([
                'order_id' =>  $order_number,
                'order_amount' => $amount,
                "order_currency" => "INR",
                "customer_details" => [
                    "customer_id" => $customer_id,
                    "customer_name" => $user_name,
                    "customer_email" => $user_email,
                    "customer_phone" => $phone_no,
                ],
                "order_meta" => [
                    "return_url" => env('APP_URL').'cashfree/payments/success/?order_id={order_id}'
                ]
            ]);
            
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            //dd($resp);
            return redirect()->to(json_decode($resp)->payment_link);
        }else{
            $this->cart_update_after_order_place($order_id);
            return redirect()->route('order_success', [base64_encode($order_id)]);
        }
        /***** Payment process end ****/
    }

    public function cashfree_success(Request $request)
    {
        //dd($request->all()); // PAYMENT STATUS RESPONSE
        $order_id = $request->order_id;
        $order_details = OrderModel::where('order_number', $order_id)->get()->first(); 
        $orderId = $order_details->id;

        $url = "https://sandbox.cashfree.com/pg/orders/".$order_id."/settlements"; // sandbox
        //$url = "https://api.cashfree.com/pg/orders/".$order_id."/settlements"; // production

        $headers = array(
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: ".env('CASHFREE_API_KEY'),
            "x-client-secret: ".env('CASHFREE_API_SECRET')
        );

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $settlement_data = json_decode($response);
        $cf_payment_id = $settlement_data->cf_payment_id;
        $cf_settlement_id = $settlement_data->cf_settlement_id;
        $order_amount = $settlement_data->order_amount;
        $payment_time = $settlement_data->payment_time;
        $payment_time = date('Y-m-d H:i:s', strtotime($payment_time));
        $service_charge = $settlement_data->service_charge;
        $service_tax = $settlement_data->service_tax;
        $settlement_amount = $settlement_data->settlement_amount;

        OrderModel::where('id', $orderId)->update([
            'payment_status' => 1,
            'transaction_id' => $cf_payment_id
        ]);

        $paymentObject = new CashfreeModel();
        $paymentObject->order_id = $orderId;
        $paymentObject->cf_payment_id = $cf_payment_id;
        $paymentObject->cf_settlement_id = $cf_settlement_id;
        $paymentObject->order_amount = $order_amount;
        $paymentObject->payment_time = $payment_time;
        $paymentObject->service_charge = $service_charge;
        $paymentObject->service_tax = $service_tax;
        $paymentObject->settlement_amount = $settlement_amount;
        $paymentObject->save();

        $this->cart_update_after_order_place($orderId);
        return redirect()->route('order_success', [base64_encode($orderId)]);

    }

    public function cart_update_after_order_place($id_order){
        $orderStatusObject = new OrderStatusModel();
        $orderStatusObject->order_id = $id_order;
        $orderStatusObject->status_catalog_id = 1;
        $orderStatusObject->save();

        $all_items = OrderItemModel::where('order_id', $id_order)->orderBy('id', 'DESC')->get();
        foreach($all_items as $key=>$item){
            $variation_id = $item->product_id;
            $size_id = $item->size_id;
            $quantity = $item->quantity;

            $variation_details = VariationModel::where('id', $variation_id)->get()->first();
            $product_id = $variation_details->product_id;

            $inventory_details = InventoryModel::where('product_id', $product_id)->where('option_id', 2)->where('option_value_id', $size_id)->get()->first();
            $inventory_id = $inventory_details->id;
            $current_stock = $inventory_details->current_stock;
            $new_stock = $current_stock-$quantity;

            InventoryModel::where('id', $inventory_id)->update([
                'current_stock' => $new_stock
            ]);
        }

        \Cart::clear();

        return 'success';
    }

    public function order_success($id){
        $order_id = base64_decode($id);
        $order_details = OrderModel::with('user_details')->with('shipping_address')->where('id', $order_id)->get()->first(); 

        return view('pages.frontend.order-success', ['order_id'=>$order_id, 'order_details'=>$order_details]);
    }

    public function my_order(){
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->get()->first();
        $user_details = UserDetails::where('user_id', $user_id)->get()->first();
        $all_status = StatusCatalogModel::where('is_active', 1)->orderBy("order", "asc")->get();
        $order_query = OrderModel::with('order_items')->where('customer_id', $user_id)->where('payment_status', 1)->orderBy("id", "desc");
        $orders = $order_query->paginate(10);

        //dd($orders->all());
        return view('pages.frontend.my-order', ['orders'=>$orders, 'user'=>$user, 'user_details'=>$user_details, 'all_status'=>$all_status]);
    }

    public function filtering_my_order(Request $request){
        $user_id = Auth::id();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status_id = $request->status_id;

        $order_query = OrderModel::with('order_items')->where('customer_id', $user_id)->where('payment_status', 1)->orderBy("id", "desc");

        if($from_date!= "" && $to_date!=""){
            $from_date = date('Y-m-d', strtotime($from_date));
            $to_date = date('Y-m-d', strtotime($to_date));
            if($to_date >= $from_date){
                $order_query->where('order.created_at', '>=', $from_date);
                $order_query->where('order.created_at', '<=', $to_date);
            }
        }

        if($status_id != ""){
            $order_query->where(DB::raw("(SELECT `status_catalog_id` FROM `order_status` WHERE `order_id`=`order`.`id` order by `id` desc limit 1)"), '=', $status_id );
        }

        $orders = $order_query->paginate(10);
        return view('pages.frontend.my-order-child', ['orders'=>$orders]);
    }

    public function order_details($id){
        $order_id = base64_decode($id);
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->get()->first();
        $user_details = UserDetails::where('user_id', $user_id)->get()->first();
        $order_details = OrderModel::with('order_items')->where('customer_id', $user_id)->where('id', $order_id)->where('payment_status', 1)->orderBy("id", "desc")->get();

        return view('pages.frontend.order-details', ['orders'=>$order_details, 'user'=>$user, 'user_details'=>$user_details]);
    }

    public function submit_product_review(Request $request){
        if($request->review_id == ""){
            $user_id = Auth::id();
            $ratingObject = new RatingReviewModel();
            $ratingObject->user_id = $user_id;
            $ratingObject->product_id = $request->product_id;
            $ratingObject->rating = $request->rate;
            $ratingObject->review = $request->product_feedback;
            $ratingObject->save();

            $msg = 'Review added successfully.';
        }else{
            RatingReviewModel::where('id', $request->review_id)->update([
                'rating' => $request->rate,
                'review' => $request->product_feedback,
            ]);
            $msg = 'Review updated successfully.';
        }
        
        return response()->json([
            'status'=> true, 
            'msg' => $msg
        ]);
    }

    public function fetch_product_review(Request $request){
        $review_details = RatingReviewModel::where('id', $request->review_id)->get()->first();
        return response()->json([
            'status'=> true, 
            'review_details' => $review_details
        ]);
    }

    public function fetch_show_more_product_review(Request $request){
        $product_id = $request->product_id;
        $review_offset = $request->review_offset;

        $review_list = RatingReviewModel::with('user_details')->where('product_id', $product_id)->where('status', 1)->skip($review_offset)->orderBy("id", "desc")->take(4)->get();
        $next_offset = $review_offset+4;

        return response()->json([
            'status'=> true, 
            'review_list' => $review_list,
            'next_offset' => $next_offset
        ]);
    }

    public function fetch_if_product_purchased(Request $request){
        $user_id = Auth::id();
        $product_id = $request->product_id;

        $all_order_items_query = 
        OrderItemModel::select([
            'order_item.id',
        ])
        ->join('order', 'order.id', '=', 'order_item.order_id')
        ->where('order.customer_id', $user_id)
        ->where('order_item.product_id', $product_id);

        $all_order_item_num = $all_order_items_query->count();

        if($all_order_item_num > 0){
            $review_proceed = 'yes';
        }else{
            $review_proceed = 'no';
        }

        return response()->json([
            'review_proceed'=> $review_proceed
        ]);
    }

    public function search_product_list(Request $request){
        $search_key = $request->search_key;

        $product_query = VariationModel::select([
            'product_variation.id',
            'product_variation.fitting_title'
        ]);
        $product_query
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->where('product_variation.is_active', '=', 1)
        ->where('products.status', '=', 1)
        ->where('products.deleted', '=', 0)
        ->groupBy('product_variation.id');

        $product_query->where(function ($query) use ($search_key) {
            $query->orWhere('category.name', 'like', "%$search_key%")
            ->orWhere('products.product_title', 'like', "%$search_key%")
            ->orWhere('product_variation.fitting_title', 'like', "%$search_key%");
        });
        
        return response()->json([
            'data'=> $product_query->get()
        ]);
    }

    public function product_exchange($id){
        $exchange_id = base64_decode($id);
        $exchange_id_obj = explode('_', $exchange_id);
        $order_id = $exchange_id_obj[0];
        $order_item_id = $exchange_id_obj[1];
        $user_id = Auth::id();
        $user_details = UserDetails::where('user_id', $user_id)->get()->first();
        
        $order_details = OrderModel::where('id', $order_id)->where('customer_id', $user_id)->get()->first();
        $order_item_details = OrderItemModel::where('id', $order_item_id)->get()->first();

        $exchange_reasons = ExchangeReasonModel::where('is_active', 1)->orderBy("id", "asc")->get();
        
        return view('pages.frontend.exchange', ['order_details'=>$order_details, 'order_item_details'=>$order_item_details, 'user_details'=>$user_details, 'exchange_reasons'=>$exchange_reasons]);
    }

    public function fetch_exchange_issue(Request $request){
        $id_reason = $request->id_reason;
        $exchange_issues = ExchangeIssueModel::where('reason_id', $id_reason)->where('is_active', 1)->orderBy("id", "asc")->get();

        return response()->json([
            'exchange_issues'=> $exchange_issues
        ]);
    }

    public function submit_exchange(Request $request){
        $exchangeObject = new ExchangeItemModel();
        $exchangeObject->order_id = $request->order_id;
        $exchangeObject->order_item_id = $request->order_item_id;
        $exchangeObject->product_id = $request->product_id;
        $exchangeObject->product_quantity = $request->product_quantity;
        $exchangeObject->exchange_price = $request->exchange_total_price;
        $exchangeObject->reason_id = $request->reason_id;
        $exchangeObject->issue_id = $request->issue_id;
        $exchangeObject->additional_remarks = $request->additional_remarks;
        $exchangeObject->is_done = 0;
        $exchangeObject->save();

        $exchange_id = $exchangeObject->id;
        $exchange_id_encoded = base64_encode($exchange_id);

        return response()->json([
            'exchange_id'=> $exchange_id_encoded
        ]);
    }

    public function exchange_product_details($id){
        $decoded_str = base64_decode($id);
        $decoded_str_arr = explode('_', $decoded_str);
        $variation_id = $decoded_str_arr[0];
        $exchange_id = $decoded_str_arr[1];
        
        $product_query = VariationModel::select([
            'product_variation.id',
            'product_variation.product_id',
            'product_variation.fitting_title',
            'product_variation.details',
            'product_variation.description',
            'category.name as cat_name',
            'type.type_name',
            'gender.gender',
            'products.product_mrp',
            'products.gst'
        ]);
        $product_query
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->with('gallery_images')
        ->with('chart_images')
        ->where('product_variation.id', '=', $variation_id);
        $product_details = $product_query->get()->first();

        $product_id = $product_details->product_id;
        $size_ids = InventoryModel::where('product_id', $product_id)->pluck('option_value_id')->toArray();
        $sizes = OptionValueModel::where('option_id', 2)->get();

        $share_link = route('front_product_details',$id);
        $product_name = $product_details->product_title;
        $shareComponent = \Share::page(
            $share_link,
            $product_name,
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()      
        ->reddit();

        $product_review = RatingReviewModel::with('user_details')->where('product_id', $variation_id)->where('status', 1)->offset(0)->limit(4)->orderByDesc('id')->get();
        $review_count = RatingReviewModel::with('user_details')->where('product_id', $variation_id)->where('status', 1)->count();
        $total_rating = RatingReviewModel::where('product_id', $variation_id)->where('status', 1)->sum('rating');
        if($total_rating == 0){
            $avearge_rating = 0;
        }else{
            $avearge_rating = $total_rating/$review_count;
            $avearge_rating = number_format($avearge_rating, 1);
        }

        $user_id = Auth::id();
        $user_review = array();
        if($user_id){
            $user_review = RatingReviewModel::with('user_details')->where('user_id', $user_id)->where('product_id', $variation_id)->get();
        }

        //$exchange_details = ExchangeItemModel::where('id', $exchange_id)->get()->first();
        
        //dd($exchange_details);
        return view('pages.frontend.exchange-product-details', ["product_details"=>$product_details, "sizes"=>$sizes, "shareComponent"=>$shareComponent, 'size_ids'=>$size_ids, 'review_count'=>$review_count, 'product_review'=>$product_review, 'user_review'=>$user_review, 'avearge_rating'=>$avearge_rating, 'exchange_id'=>$exchange_id]);
    }

    public function exchange_checkout(Request $request){
        //dd($request->all());
        $exchange_details = ExchangeItemModel::where('id', $request->exchange_id)->get()->first();
        //dd($exchange_details);
        $order_id = $exchange_details->order_id;
        $order_details = OrderModel::where('id', $order_id)->get()->first();
        $checkout_adress_id = $order_details->checkout_adress_id;

        $states = StateModel::orderBy("name", "asc")->get();
        return view('pages.frontend.exchange-checkout', ['states'=>$states, 'exchange_details'=>$exchange_details, 'checkout_adress_id'=>$checkout_adress_id, 'product_name'=>$request->product_name, 'product_id'=>$request->product_id, 'variation_id'=>$request->variation_id, 'product_stock'=>$request->product_stock, 'product_sku'=>$request->product_sku, 'product_gst'=>$request->product_gst, 'cart_price'=>$request->cart_price, 'current_mrp'=>$request->current_mrp, 'product_quantity'=>$request->product_quantity, 'gst_amount'=>$request->gst_amount, 'amount_after_gst'=>$request->amount_after_gst, 'product_size_id'=>$request->product_size_id, 'exchange_id'=>$request->exchange_id]);
    }

    public function exchange_payment(Request $request){
        //dd($request->all());
        // Exchange order creation start //
        if($request->payable_amount > 0 ){
            $payment_status = 0;
            $payment_type = "Cashfree";
        }else{
            $payment_status = 1;
            $payment_type = "No Payment";
        }

        $user_id = Auth::id();
        $orderObject = new OrderModel();
        $order_number = 'NXTEP'.date('ymdHis').rand(1000,9999);
        $orderObject->order_number = $order_number;
        $orderObject->customer_id = $user_id;
        $orderObject->order_price = $request->cart_price;
        $orderObject->promo_code_id = 0;
        $orderObject->checkout_adress_id = $request->checkout_adress_id;
        $orderObject->discount = 0;
        $orderObject->shipping_fee = 0;
        $orderObject->payment_type = $payment_type;
        $orderObject->final_price = $request->cart_price;
        $orderObject->payment_status = $payment_status;
        $orderObject->is_exchange = 'yes';
        $orderObject->exchange_id = $request->exchange_id;
        $orderObject->parent_order_id = $request->parent_order_id;
        $orderObject->save();
        $order_id = $orderObject->id;

        $orderItemObject = new OrderItemModel();
        $orderItemObject->order_id = $order_id;
        $orderItemObject->product_id = $request->variation_id;
        $orderItemObject->size_id = $request->product_size_id;
        $orderItemObject->product_name = $request->product_name;
        $orderItemObject->product_price = $request->current_mrp;
        $orderItemObject->total_price = $request->cart_price;
        $orderItemObject->sell_price = $request->amount_after_gst;
        $orderItemObject->gst = $request->gst_amount * $request->product_quantity;
        $orderItemObject->quantity = $request->product_quantity;
        $orderItemObject->sku = $request->product_sku;
        $orderItemObject->save();

        ExchangeItemModel::where('id', $request->exchange_id)->update([
            'is_done' => 1
        ]);
        // Exchange order creation end //

        // payment process start
        if($payment_status == 0){
            $address_details = CheckoutAddressModel::where('id', $request->checkout_adress_id)->get()->first();
            $user_name = $address_details->first_name.' '.$address_details->last_name;
            $phone_no = $address_details->phone_no;
            $amount = $request->payable_amount;
            $user_email = auth()->user()->email;
            $customer_id = 'customer_'.$user_id.'_'.rand(111111111,999999999);
            $url = "https://sandbox.cashfree.com/pg/orders"; // sandbox
            //$url = "https://api.cashfree.com/pg/orders"; // production

            $headers = array(
                "Content-Type: application/json",
                "x-api-version: 2022-01-01",
                "x-client-id: ".env('CASHFREE_API_KEY'),
                "x-client-secret: ".env('CASHFREE_API_SECRET')
            );
            
            $data = json_encode([
                'order_id' =>  $order_number,
                'order_amount' => $amount,
                "order_currency" => "INR",
                "customer_details" => [
                    "customer_id" => $customer_id,
                    "customer_name" => $user_name,
                    "customer_email" => $user_email,
                    "customer_phone" => $phone_no,
                ],
                "order_meta" => [
                    "return_url" => env('APP_URL').'cashfree/payments/success/?order_id={order_id}'
                ]
            ]);

            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            //dd($resp);
            return redirect()->to(json_decode($resp)->payment_link);
        }else{
            $this->cart_update_after_order_place($order_id);
            return redirect()->route('order_success', [base64_encode($order_id)]);
        }
        // payment process end
    }

    public static function is_exchange_btn_show($order_item_id){
        $exchange_btn_show = 'yes';
        $order_item = OrderItemModel::where('id', $order_item_id)->get()->first();
        $order_id = $order_item->order_id;

        $order_details = OrderModel::where('id', $order_id)->get()->first();
        $order_created_at = $order_details->created_at;
        $is_exchange = $order_details->is_exchange;

        if($is_exchange == 'yes'){
            $exchange_btn_show = 'no';
        }
        
        $exchange_details_count = ExchangeItemModel::where('order_id', $order_id)->where('order_item_id', $order_item_id)->where('is_done', 1)->get()->count();
        
        if($exchange_details_count > 0){
            $exchange_btn_show = 'no';
        }

        $now = time(); 
        $your_date = strtotime($order_created_at);
        $datediff = $now - $your_date;

        $number_of_days =  round($datediff / (60 * 60 * 24));
        
        if($number_of_days > 7){
            $exchange_btn_show = 'no';
        }

        $order_status = 
        OrderStatusModel::select([
            'status_catalog.status_name'
        ])
        ->join('status_catalog', 'status_catalog.id', '=', 'order_status.status_catalog_id')
        ->where('order_status.order_id', $order_id)
        ->orderByDesc("order_status.id")
        ->limit(1)
        ->first();
        $status_name = $order_status->status_name;

        if($status_name != 'Delivered'){
            $exchange_btn_show = 'no';
        }
        return $exchange_btn_show;
    }
    /**
     * Product frontend operarion end
    */
}
