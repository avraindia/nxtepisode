<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HomepageSectionModel;
use App\Models\VariationModel;
use App\Models\SectionProductModel;
use App\Models\CollectionItemModel;
use App\Models\CategoryModel;
use App\Models\TypeModel;
use App\Models\OptionModel;
use App\Models\GenderModel;
use App\Models\ThemeModel;
use App\Models\CollectionProductModel;
use App\Models\HomepageBannerModel;

class HomepageController extends Controller
{
    public function add_homepage_section()
    {
        return view('pages.admin.add-homepage-section');
    }

    public function save_homepage_section(Request $request){
        if($request->section_id){
            HomepageSectionModel::where('id', $request->section_id)->update([
                'section_name' => $request->section_name,
                'image_ratio' => $request->image_ratio,
                'section_order' => $request->section_order
            ]);

            return redirect()->route('all_sections')->with(['successmsg' => 'Section updated successfully.']);
        }else{
            $sectionObject = new HomepageSectionModel();
            $sectionObject->section_name = $request->section_name;
            $sectionObject->section_type = $request->section_type;
            $sectionObject->image_ratio = $request->image_ratio;
            $sectionObject->section_order = $request->section_order;
            $sectionObject->save();

            return redirect()->route('all_sections')->with(['successmsg' => 'Section added successfully.']);
        }
    }

    public function all_sections(){
        $sections = HomepageSectionModel::orderBy("section_order", "asc")->get();
        return view('pages.admin.all-sections', ['sections'=>$sections]);
    }

    public function edit_homepage_section($id){
        $section_details = HomepageSectionModel::where('id', $id)->get()->first();

        return view('pages.admin.edit-homepage-section', ['section_details'=>$section_details]);
    }

    public function add_section_product($id){
        $categories = CategoryModel::all();
        $types = TypeModel::all();
        $options = OptionModel::with('option_values')->get();
        $genders = GenderModel::orderBy("id", "asc")->get();
        $all_themes = ThemeModel::orderBy('id')->get();

        $section_details = HomepageSectionModel::where("id", $id)->get()->first();
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

        $products = $product_query->paginate(10);
        $productIdArr = SectionProductModel::where("section_id", $id)->pluck('product_id')->toArray();
        //dd($section_product_details);
        return view('pages.admin.add-section-product', ['section_details'=>$section_details, 'products'=>$products, 'productIdArr'=>$productIdArr, 'categories'=>$categories, 'types'=>$types, 'options'=>$options, 'genders'=>$genders, 'all_themes'=>$all_themes]);
    }

    public function filtering_section_product(Request $request){
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
        $products = $product_query->paginate(10);
        $productIdArr = SectionProductModel::where("section_id", $request->section_id)->pluck('product_id')->toArray();

        return view('pages.admin.section-product-list-child', ['products'=>$products, 'productIdArr'=>$productIdArr]);
    }

    public function add_homepage_section_product(Request $request){
        if($request->is_checked == 'yes'){
            $sectionObject = new SectionProductModel();
            $sectionObject->product_id = $request->product_id;
            $sectionObject->section_id = $request->section_id;
            $sectionObject->save();
        }

        if($request->is_checked == 'no'){
            SectionProductModel::where('product_id',$request->product_id)->where('section_id',$request->section_id)->delete();
        }

        return response()->json([
            'status'=> true
        ]);
    }

    public function collection_list($id){
        $section_details = HomepageSectionModel::where("id", $id)->get()->first();
        $collection_items = CollectionItemModel::where("section_id", $id)->get();
        //dd($image_gallery);
        return view('pages.admin.collection-list', ['section_details'=>$section_details, 'collection_items'=>$collection_items]);
    }

    public function home()
    {
        $top_banner_images = HomepageBannerModel::where("type", "top")->get();
        $foot_banner_images = HomepageBannerModel::where("type", "foot")->get();
        
        $sections = HomepageSectionModel::with('section_products')->with('section_collection')->orderBy("section_order", "asc")->get();
        
        return view('pages.frontend.home', ['sections'=>$sections, 'top_banner_images'=>$top_banner_images, 'foot_banner_images'=>$foot_banner_images]);
    }

    public function add_collection($id){
        return view('pages.admin.add-collection', ['section_id'=>$id]);
    }

    public function save_collection_item(Request $request){
        $collectionItemObject = new CollectionItemModel();
        $collectionItemObject->section_id = $request->section_id;
        $collectionItemObject->item_name = $request->collection_name;
        $collectionItemObject->item_order = $request->collection_order;
        if($request->hasFile('collection_image')){
            $section_image = $request->file('collection_image');
            $filenameWithExt = $section_image->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $section_image->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $section_image->storeAs('public/uploads/section_image', $fileNameToStore);

            $collectionItemObject->image_name = $fileNameToStore;
        }
        $collectionItemObject->save();

        return redirect()->route('collection_list', $request->section_id)->with(['successmsg' => 'Collection Item added successfully.']);
    }

    public function collection_product($id){
        $collection_item = CollectionItemModel::where("id", $id)->get()->first();

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

        $products = $product_query->paginate(10);
        $productIdArr = CollectionProductModel::where("item_id", $id)->pluck('product_id')->toArray();
        
        return view('pages.admin.add-collection-product', ['collection_item'=>$collection_item, 'products'=>$products, 'productIdArr'=>$productIdArr, 'categories'=>$categories, 'types'=>$types, 'options'=>$options, 'genders'=>$genders, 'all_themes'=>$all_themes]);
    }

    public function filtering_collection_product(Request $request){
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
        $products = $product_query->paginate(10);
        $productIdArr = CollectionProductModel::where("item_id", $request->item_id)->pluck('product_id')->toArray();

        return view('pages.admin.section-product-list-child', ['products'=>$products, 'productIdArr'=>$productIdArr]);
    }

    public function add_homepage_collection_product(Request $request){
        if($request->is_checked == 'yes'){
            $sectionObject = new CollectionProductModel();
            $sectionObject->product_id = $request->product_id;
            $sectionObject->section_id = $request->section_id;
            $sectionObject->item_id = $request->item_id;
            $sectionObject->save();
        }

        if($request->is_checked == 'no'){
            CollectionProductModel::where('product_id',$request->product_id)->where('section_id',$request->section_id)->where('item_id',$request->item_id)->delete();
        }

        return response()->json([
            'status'=> true
        ]);
    }

    public function edit_collection($id){
        $collection_item = CollectionItemModel::where("id", $id)->get()->first();
        return view('pages.admin.edit-collection', ['collection_item'=>$collection_item]);
    }

    public function update_collection_item(Request $request){
        CollectionItemModel::where('id', $request->collection_item_id)->update([
            'item_name' => $request->collection_name,
            'item_order' => $request->collection_order
        ]);

        if($request->hasFile('collection_image')){
            $section_image = $request->file('collection_image');
            $filenameWithExt = $section_image->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $section_image->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $section_image->storeAs('public/uploads/section_image', $fileNameToStore);

            CollectionItemModel::where('id', $request->collection_item_id)->update([
                'image_name' =>  $fileNameToStore
            ]);
        }

        return redirect()->route('collection_list', $request->section_id)->with(['successmsg' => 'Collection Item updated successfully.']);
    }

    public function delete_collection_item($id){
        CollectionProductModel::where('item_id', $id)->delete();
        $item=CollectionItemModel::find($id);
        $item->delete();

        return redirect()->back()->with(['successmsg' => 'Collection deleted successfully.']);
    }

    public function add_banner_image($type){
        $banner_images = HomepageBannerModel::where("type", $type)->get();
        return view('pages.admin.add-banner-image', ['type'=>$type, 'banner_images'=>$banner_images]);
    }

    public function save_banner_image(Request $request){
        if($request->hasFile('banner_image')){
            $banner_images = $request->file('banner_image');
            foreach($banner_images as $banner_image){
                $bannerImageObject = new HomepageBannerModel();
                $bannerImageObject->type = $request->banner_type;
                $filenameWithExt = $banner_image->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $banner_image->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $banner_image->storeAs('public/uploads/banner_image', $fileNameToStore);

                $bannerImageObject->image_name = $fileNameToStore;
                $bannerImageObject->save();
            }
        }
        return redirect()->back()->with(['successmsg' => 'Image added successfully.']);
    }

    public function delete_banner_image($id){
        $img=HomepageBannerModel::find($id);
        $img->delete();

        return redirect()->back()->with(['successmsg' => 'Image deleted successfully.']);
    }
}
