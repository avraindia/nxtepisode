<?php

namespace App\Http\Controllers;

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
        $productObject->theme_ids = $theme_ids;
        $productObject->status = $is_available;
        $productObject->save();

        return redirect()->route('all_products')->with(['successmsg' => 'Product added successfully.']);
    }

    public function product_details($id){
        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();
        $genders = GenderModel::orderBy("id", "asc")->get();
        $product_details = ProductModel::where('id', $id)->get()->first();
        $product_images = ProductgalleryModel::where('product_id', $id)->get();
        $all_themes = ThemeModel::orderBy('id')->get();
        return view('pages.admin.product-details', ['parent_categories'=>$parent_categories, 'genders'=>$genders, 'product_details'=>$product_details, 'product_images'=>$product_images, 'all_themes' => $all_themes]);
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
            'gender_id' => $request->product_gender,
            'product_mrp' => $request->product_mrp,
            'theme_ids' => $theme_ids,
            'status' => $is_available,
            'details' => $this->clearEditorString($request->product_details),
            'description' => $this->clearEditorString($request->product_description)
        ]);

        if($request->hasFile('product_image')){
            $gallery_images = $request->file('product_image');
            foreach($gallery_images as $gallery_image){
                $galleryObject = new ProductgalleryModel();
                $galleryObject->product_id = $product_id;
                $filenameWithExt = $gallery_image->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $gallery_image->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                // Upload Image
                $path = $gallery_image->storeAs('public/uploads/product_gallery', $fileNameToStore);

                $galleryObject->product_image = $fileNameToStore;
                $galleryObject->save();
            }
        }

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
        return view('pages.frontend.products-child', ['product_count' => $product_count, 'all_products' => $all_products]);

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
            'products.product_mrp'
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

        return view('pages.frontend.product-details', ["product_details"=>$product_details, "sizes"=>$sizes, "shareComponent"=>$shareComponent, 'size_ids'=>$size_ids]);
    }

    public function check_variation_exists(Request $request){
        $product_id = $request->product_id;
        $size_id = $request->size_id;
        $variation_rec = array();

        $inventory_query = InventoryModel::where('product_id', $product_id)->where('option_value_id', $size_id);
        $check_num = $inventory_query->count();
        if($check_num>0){
            $inventory_rec = $inventory_query->get()->first();
        }

        return response()->json([
            'status'=> true, 
            'num' => $check_num,
            'inventory_rec' => $inventory_rec
        ]);
    }

    /**
     * Product frontend operarion end
    */
}
