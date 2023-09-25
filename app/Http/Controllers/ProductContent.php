<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductgalleryModel;
use App\Models\SizegalleryModel;
use App\Models\OptionModel;
use App\Models\OptionValueModel;
use App\Models\VariationModel;
use App\Models\GenderModel;
use App\Models\InventoryModel;
use App\Models\TypeModel;
use App\Models\ThemeModel;
use Intervention\Image\Facades\Image as Image;

class ProductContent extends Controller
{
    /**
     * Category operarion start
    */
    public function view_categories()
    {
        $categories = CategoryModel::orderByDesc('id');
        $all_categories = $categories->paginate(10);
        return view('pages.admin.all-categories', ['all_categories' => $all_categories]);
    }

    public function add_category()
    {
        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();
        return view('pages.admin.add-category', ['parent_categories' => $parent_categories]);
    }

    public function save_category(Request $request){
        $categoryObject = new CategoryModel();
        $categoryObject->name = $request->cat_name;
        $categoryObject->parent_id = $request->parent_cat_id;
        $categoryObject->description = $request->description;

        if($request->hasFile('category_image')){
            $category_image = $request->file('category_image');

            $filenameWithExt = $category_image->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $category_image->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $category_image->storeAs('public/uploads/category_image', $fileNameToStore);

            $categoryObject->category_image = $fileNameToStore;
        }

        $categoryObject->save();

        return redirect()->route('all_categories');
    }

    public function edit_category($id)
    {
        $category_details = CategoryModel::where('id', $id)->get() ->first();
        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();
        return view('pages.admin.edit-category', ['parent_categories' => $parent_categories, 'category_details' => $category_details]);
    }

    public function update_category(Request $request){

        $catUpd = CategoryModel::where('id', $request->cat_id)->update([
            'name' => $request->cat_name,
            'parent_id' => $request->parent_cat_id,
            'description' => $request->description
        ]);

        if($request->hasFile('category_image')){
            $category_image = $request->file('category_image');

            $filenameWithExt = $category_image->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $category_image->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $category_image->storeAs('public/uploads/category_image', $fileNameToStore);

            CategoryModel::where('id', $request->cat_id)->update([
                'category_image' => $fileNameToStore
            ]);
        }

        return redirect()->route('all_categories');
    }

    public function fetch_child_category(Request $request){
        $category_details = CategoryModel::where('parent_id', $request->parent_cat_id)->get();
        return response()->json([
            'status'=> true, 
            'category_details' => $category_details
        ]);
    }

    public static function getCategoryNameById($id){
        $category_details = CategoryModel::where('id', $id)->get() ->first();
        return $category_details->name;
    }

    public function category_delete($id){
        $check_row = ProductModel::where('main_cat_id', $id)
            ->orWhere('sub_cat_id', $id)
            ->get()
            ->count();

        if($check_row > 0){
            return redirect()->back()->with(['errmsg' => 'Product exists in this category. Can not be deleted.']);
        }else{
            $cat=CategoryModel::find($id);
            $cat->delete();
            return redirect()->back()->with(['successmsg' => 'Category deleted successfully.']);
        }
    }

    /**
     * Category operarion end
    */

    /**
     * Option operarion end
    */
    public function options(){
        $all_options = OptionModel::orderBy('id')->get();
        return view('pages.admin.options', ['all_options' => $all_options]);
    }

    public function save_option(Request $request){
        if($request->option_id == ""){
            $optionObject = new OptionModel();
            $optionObject->option_name = $request->option_name;
            $optionObject->option_description = $request->option_description;

            $optionObject->save();
            return redirect()->back()->with(['successmsg' => 'Option added successfully.']);
        }else{
            $optionUpd = OptionModel::where('id', $request->option_id)->update([
                'option_name' => $request->option_name,
                'option_description' => $request->option_description,
            ]);
            return redirect()->back()->with(['successmsg' => 'Option updated successfully.']);
        }
    }

    public function add_option_value($option_id){
        $option_details = OptionModel::where('id', $option_id)->get() ->first();
        $all_option_values = OptionValueModel::where('option_id', $option_id)->get();
        return view('pages.admin.add-option-value', ['option_details'=>$option_details, 'all_option_values'=>$all_option_values]);
    }

    public function fetch_option_record(Request $request)
    {
        $option_details = OptionModel::where('id', $request->id)->get() ->first();
        return response()->json([
            'status'=> true, 
            'option_details' => $option_details
        ]);
    }

    public function delete_option($option_id){
        $value=OptionModel::find($option_id);
        $value->delete();
        return redirect()->back()->with(['successmsg' => 'Option deleted successfully.']);
    }

    public function save_option_value(Request $request)
    {
        if($request->option_value_id != ""){
            $variationUpd = OptionValueModel::where('id', $request->option_value_id)->update([
                'option_value' => $request->option_value
            ]);
        }else{
            $valueObject = new OptionValueModel();
            $valueObject->option_id = $request->option_id;
            $valueObject->option_value = $request->option_value;

            $valueObject->save();
        }
        return redirect()->back();
    }

    public static function fetch_option_value(Request $request){
        $option_value = OptionValueModel::where('id', $request->id)->get()->first();
        return $option_value;
    }

    public function delete_option_value(Request $request){
        $value=OptionValueModel::find($request->id);
        $value->delete();

        return response()->json([
            'resp'=> 1, 
            'msg' => 'Option Value deleted successfully.'
        ]);
    }
    /**
     * Option operarion end
    */

    /**
     * Inventory operarion start
    */
    public function inventory(){
        $types = TypeModel::all();
        $options = OptionModel::all();
        return view('pages.admin.inventory', ['types'=>$types, 'options'=>$options]);
    }

    public function inventory_list(){
        $inventory = 
        InventoryModel::select([
            'products.product_title',
            'products.product_mrp',
            'category.name',
            'product_inventory.inventory_price',
            'product_inventory.current_stock',
            'options.option_name',
            'option_values.option_value',
        ])
        ->join('products', 'products.id', '=', 'product_inventory.product_id')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->join('options', 'options.id', '=', 'product_inventory.option_id')
        ->join('option_values', 'option_values.id', '=', 'product_inventory.option_value_id')
        ->orderByDesc('products.id');

        $product_inventory = $inventory->paginate(10);

        $parent_categories = CategoryModel::where('parent_id', 0)->orderByDesc('id')->get();
        $option_values = OptionValueModel::where('option_id', 2)->orderByDesc('id')->get();

        return view('pages.admin.inventory-list', ['inventories'=>$product_inventory, "parent_categories"=>$parent_categories, "option_values"=>$option_values]);
    }

    public function filtering_inventory_paginate_result(Request $request){
        $inventory_query = 
        InventoryModel::select([
            'products.product_title',
            'products.product_mrp',
            'category.id',
            'category.name',
            'product_inventory.inventory_price',
            'product_inventory.current_stock',
            'options.option_name',
            'option_values.option_value',
            'product_inventory.option_value_id'
        ])
        ->join('products', 'products.id', '=', 'product_inventory.product_id')
        ->join('category', 'category.id', '=', 'products.main_cat_id')
        ->join('options', 'options.id', '=', 'product_inventory.option_id')
        ->join('option_values', 'option_values.id', '=', 'product_inventory.option_value_id')
        ->orderByDesc('products.id');

        if(request('search_key')){
            $search_key = request('search_key');
            $inventory_query->where(function($inventory_query) use($search_key) {
                $inventory_query->orWhere('products.product_title', 'like', "%$search_key%");
            });
        }

        if(request('cat_id') != '0'){
            $inventory_query->where('category.id', '=', request('cat_id'));
        }

        if(request('size_id') != '0'){
            $inventory_query->where('product_inventory.option_value_id', '=', request('size_id'));
        }

        $product_inventory = $inventory_query->paginate(10);

        return view('pages.admin.inventory-child', ['inventories' => $product_inventory]);
    }

    public function search_inventory_product(Request $request){
        $search_key = $request->search_term;

        $product_query = ProductModel::select([
            'products.id',
            'products.product_title',
            'products.product_mrp',
            'products.main_cat_id',
        ]);
        $product_query->where(function($product_query) use($search_key) {
            $product_query->orWhere('products.product_title', 'like', "%$search_key%");
        });

        $products = $product_query->get();
        return response()->json([
            'resp'=> true, 
            'data' => $products
        ]);
    }

    public function inventory_option_value(Request $request){
        $option_value = OptionValueModel::where('option_id', $request->option_id)->get();
        return response()->json([
            'resp'=> true, 
            'data' => $option_value
        ]);
    }

    public function check_existing_stock(Request $request){
        $product_inventory = 
        InventoryModel::
        where('product_id', $request->product_id)
        ->where('option_id', $request->option_id)
        ->where('option_value_id', $request->option_value_id)
        ->get();

        $product_inventory_count = $product_inventory->count();
        if($product_inventory_count > 0){
            $product_inventory_record = $product_inventory->first();
            $inventory_id = $product_inventory_record->id;
            $inventory_price = $product_inventory_record->inventory_price;
            $inventory_stock = $product_inventory_record->current_stock;
        }else{
            $inventory_price = 0;
            $inventory_stock = 0;
            $inventory_id = 0;
        }

        return response()->json([
            'resp'=> true, 
            'inventory_id' => $inventory_id,
            'inventory_price' => $inventory_price,
            'inventory_stock' => $inventory_stock,
            'product_inventory_count' => $product_inventory_count
        ]);
    }

    public function save_inventory_value(Request $request){
        $inventory_id = $request->inventory_id;
        $option_id = $request->option_id;
        $option_value_id = $request->option_value_id;
        $product_id = $request->product_id;
        $inventory_price = $request->inventory_price;
        $inventory_stock = $request->inventory_stock;
        $existing_stock_value = $request->existing_stock_value;

        if($inventory_id == 0){
            $inventoryObject = new InventoryModel();
            $inventoryObject->product_id = $product_id;
            $inventoryObject->option_id = $option_id;
            $inventoryObject->option_value_id = $option_value_id;
            $inventoryObject->inventory_price = $inventory_price;
            $inventoryObject->current_stock = $inventory_stock;

            $inventoryObject->save();
            $inventory_id = $inventoryObject->id;

            $msg = 'Stock added successfully.';
        }else{
            $new_stock = $inventory_stock+$existing_stock_value;
            InventoryModel::where('id', $inventory_id)->update([
                'inventory_price' => $inventory_price,
                'current_stock' => $new_stock,
            ]);
            $msg = 'Stock updated successfully.';
        }

        return response()->json([
            'resp'=> true, 
            'inventory_id' => $inventory_id,
            'msg' => $msg
        ]);
    }

    /**
     * Inventory operarion end
    */

    /**
     * Theme operarion Start
    */
    public function themes(){
        $all_themes = ThemeModel::orderBy('id')->get();
        return view('pages.admin.themes', ['all_themes' => $all_themes]);
    }

    public function save_theme(Request $request){
        if($request->theme_id == ""){
            $themeObject = new ThemeModel();
            $themeObject->theme_name = $request->theme_name;
            $themeObject->theme_description = $request->theme_description;

            $themeObject->save();
            return redirect()->back()->with(['successmsg' => 'Theme added successfully.']);
        }else{
            $themeUpd = ThemeModel::where('id', $request->theme_id)->update([
                'theme_name' => $request->theme_name,
                'theme_description' => $request->theme_description,
            ]);
            return redirect()->back()->with(['successmsg' => 'Theme updated successfully.']);
        }
    }

    public function fetch_theme_record(Request $request)
    {
        $theme_details = ThemeModel::where('id', $request->id)->get() ->first();
        return response()->json([
            'status'=> true, 
            'theme_details' => $theme_details
        ]);
    }

    public function fitting_list($id){
        $product_fitting_query = 
        VariationModel::select([
            'product_variation.fitting_title',
            'product_variation.fitting_type',
            'product_variation.gender AS gender_id',
            'product_variation.is_active',
            'products.product_title',
            'products.product_mrp',
            'type.type_name',
            'gender.gender',
            
        ])
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->where('product_variation.product_id', '=', $id);

        $genders = GenderModel::orderBy("id", "asc")->get();
        $types = TypeModel::all();

        $product_fitting_list = $product_fitting_query->paginate(10);
        return view('pages.admin.fitting-list', ['product_id'=>$id, 'fittings'=>$product_fitting_list, 'genders'=>$genders, 'types'=>$types]);
    }

    public function filtering_fitting_paginate_result(Request $request){
        $product_fitting_query = 
        VariationModel::select([
            'product_variation.fitting_title',
            'product_variation.fitting_type',
            'product_variation.gender AS gender_id',
            'product_variation.is_active',
            'products.product_title',
            'products.product_mrp',
            'type.type_name',
            'gender.gender',
            
        ])
        ->join('products', 'products.id', '=', 'product_variation.product_id')
        ->join('type', 'type.id', '=', 'product_variation.fitting_type')
        ->join('gender', 'gender.id', '=', 'product_variation.gender')
        ->where('product_variation.product_id', '=', $request->product_id);

        if(request('search_key')){
            $search_key = request('search_key');
            $product_fitting_query->where(function($product_fitting_query) use($search_key) {
                $product_fitting_query->orWhere('products.product_title', 'like', "%$search_key%");
                $product_fitting_query->orWhere('product_variation.fitting_title', 'like', "%$search_key%");
            });
        }

        if(request('gender_id') != '0'){
            $product_fitting_query->where('product_variation.gender', '=', request('gender_id'));
        }

        if(request('type_id') != '0'){
            $product_fitting_query->where('product_variation.fitting_type', '=', request('type_id'));
        }

        $product_fitting_list = $product_fitting_query->paginate(10);
        return view('pages.admin.fitting-child', ['fittings' => $product_fitting_list]);
    }


    /**
     * Theme operarion End
    */

    /**
     * Product variation operarion Start
    */

    public function add_variation($id){
        $product_details = ProductModel::where('id', $id)->get()->first();
        $genders = GenderModel::orderBy("id", "asc")->get();
        $types = TypeModel::all();
        return view('pages.admin.add-variation', ['product_details' => $product_details, 'genders' => $genders, 'types' => $types]);
    }

    public function save_variation(Request $request){
        //dd($request->all());
        $fitting_action = $request->fitting_action;
        $variation_id = $request->variation_id;
        $fitting_type_id = $request->fitting_type;
        $fitting_gender_id = $request->fitting_gender;
        $fitting_title = $request->fitting_title;
        $fitting_details = $request->fitting_details;
        $fitting_description = $request->fitting_description;
        $product_id = $request->product_id;

        if($request->is_available == 'on'){
            $is_available = 1;
        }else{
            $is_available = 0;
        }

        if($fitting_action == 'add'){
            $fittingObject = new VariationModel();
            $fittingObject->product_id = $product_id;
            $fittingObject->fitting_title = $fitting_title;
            $fittingObject->fitting_type = $fitting_type_id;
            $fittingObject->gender = $fitting_gender_id;
            $fittingObject->details = $this->clearEditorString($fitting_details);
            $fittingObject->description = $this->clearEditorString($fitting_description);
            $fittingObject->is_active = $is_available;

            $fittingObject->save();
            $variation_id = $fittingObject->id;
        }

        if($fitting_action == 'edit'){
            VariationModel::where('id', $variation_id)->update([
                'fitting_title' => $fitting_title,
                'details' => $this->clearEditorString($fitting_details),
                'description' => $this->clearEditorString($fitting_description),
                'is_active' => $is_available
            ]);
        }

        if($request->hasFile('fitting_image')){
            $gallery_images = $request->file('fitting_image');
            foreach($gallery_images as $gallery_image){
                $productGalleryObject = new ProductgalleryModel();
                $productGalleryObject->product_variation_id = $variation_id;
                $filenameWithExt = $gallery_image->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $gallery_image->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $thumbnail_path = storage_path('app/public/uploads/product_thumbnails/')  . $fileNameToStore;
                $details_path = storage_path('app/public/uploads/product_details/')  . $fileNameToStore;

                // Upload Image
                Image::make($gallery_image->getRealPath())->resize(192, 283)->save($thumbnail_path);
                Image::make($gallery_image->getRealPath())->resize(635, 590)->save($details_path);
                $productGalleryObject->product_image = $fileNameToStore;
                $productGalleryObject->save();
            }
        }

        if($request->hasFile('size_chart_image')){
            $size_images = $request->file('size_chart_image');
            foreach($size_images as $size_image){
                $sizeGalleryObject = new SizegalleryModel();
                $sizeGalleryObject->product_variation_id = $variation_id;
                $filenameWithExt = $size_image->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $size_image->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $store_path = storage_path('app/public/uploads/size_chart/')  . $fileNameToStore;

                // Upload Image
                Image::make($size_image->getRealPath())->resize(635, 590)->save($store_path);
                $sizeGalleryObject->size_image = $fileNameToStore;
                $sizeGalleryObject->save();
            }
        }

        return redirect()->route('fitting_list', $product_id)->with('successmsg', 'Fitting saved successfully.');
    }

    public function fetch_existing_fitting_type(Request $request){
        $product_id = $request->product_id;
        $fitting_type_id = $request->fitting_type;
        $fitting_gender_id = $request->fitting_gender;

        $product_fitting = 
        VariationModel::
        with('gallery_images')
        ->with('chart_images')
        ->where('product_id', $product_id)
        ->where('fitting_type', $fitting_type_id)
        ->where('gender', $fitting_gender_id)
        ->get();

        $product_fitting_count = $product_fitting->count();
        if($product_fitting_count > 0){
            $is_exist = 'yes';
            $product_fitting_record = $product_fitting->first();
        }else{
            $is_exist = 'no';
            $product_fitting_record = array();
        }

        return response()->json([
            'resp'=> true, 
            'is_exist' => $is_exist,
            'data' => $product_fitting_record
        ]);
    }

    /**
     * Product variation operarion End
    */

    function clearEditorString($string){
        if (str_contains($string, '<!--StartFragment-->')) {
            $string = trim(str_replace('<!--StartFragment-->','',$string));
        }
        if (str_contains($string, '<!--EndFragment-->')) {
            $string = trim(str_replace('<!--EndFragment-->','',$string));
        }
        if (str_contains($string, '<p><br></p>')) {
            $string = trim(str_replace('<p><br></p>','',$string));
        }
    
        return $string;
    }
}
