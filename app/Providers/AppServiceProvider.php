<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\SettingsModel;
use App\Models\CategoryModel;
use App\Models\GenderModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        $shipping_fee_inside_west_bengal = SettingsModel::where('meta_title','shipping_fee_inside_west_bengal')->first()->meta_value;
        $shipping_fee_outside_west_bengal = SettingsModel::where('meta_title','shipping_fee_outside_west_bengal')->first()->meta_value;
        $global_gst = SettingsModel::where('meta_title','global_gst')->first()->meta_value;
        $global_genders = GenderModel::orderBy("id", "asc")->get();
        $categories = CategoryModel::orderBy('id','asc')->get();

        View::share('shipping_fee_inside_west_bengal', $shipping_fee_inside_west_bengal);
        View::share('shipping_fee_outside_west_bengal', $shipping_fee_outside_west_bengal);
        View::share('global_categories', $categories);
        View::share('global_gst', $global_gst);
        View::share('global_genders', $global_genders);
    }
}
