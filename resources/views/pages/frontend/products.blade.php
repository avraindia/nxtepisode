@extends('layouts.front')
@section('content')
<!-- <-----------------Banner section start--------------->
<section class="home-page-main-banner all-section-banner">
    <div class="main-banner-image">
        <img src="{{ asset('frontend/images/home-page-banner.jpg') }}" alt="">
    </div>
    <div class="home-page-banner-inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="main-banner-text">
                        <h1>Products</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="product-list-section">
    <div class="container">
        <div class="filter-select-section">
            <div class="row justify-content-md-end">
                <div class="col-lg-3 col-md-4">
                    <div class="product-select-search-section product-select-desktop">
                        <select name="cars" id="products" class="order_by_desktop">
                            <option selected disabled>Select Sorting Options</option>
                            <option value="price_high_to_low">Price-High to Low</option>
                            <option value="price_low_to_high">Price-Low to High</option>
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @include('pages.frontend.products-filter')  
            <div class="col-lg-9 col-md-8 col-12">
                <div class="product-filter-product-image-category-section product_list">
                    @include('pages.frontend.products-child')  
                </div>
            </div>
        </div>
    </div>
    <div class="filterration-show-hide-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 col-12">
                    <button id="show-filter-option" class="show-filter"><i class="fa-sharp fa-solid fa-filter"></i> &nbsp;Filter</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->
@stop

@push('scripts')
<script>
$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

$(document).on('click', '.page-link', function(e) {
e.preventDefault();
var page = $(this).attr('href').split('page=')[1];
if(page!=""){
    getFilteringBody(page);
}
});

$(document).on('change', '.product_cat', function(e) {
    getFilteringBody(1);
});

$(document).on('change', '.fitting_type', function(e) {
    getFilteringBody(1);
});

$(document).on('change', '.option_value', function(e) {
    getFilteringBody(1);
});

$(document).on('change', '.product_gender', function(e) {
    getFilteringBody(1);
});

$(document).on('change', '.product_stock', function(e) {
    getFilteringBody(1);
});

$(document).on('change', '.product_theme', function(e) {
    getFilteringBody(1);
});

$(document).on('change', '.order_by_desktop', function(e) {
    var order_by_val = $(this).val();
    $('.order_by_mobile').val(order_by_val);
    getFilteringBody(1);
});

$(document).on('change', '.order_by_mobile', function(e) {
    var order_by_val = $(this).val();
    $('.order_by_desktop').val(order_by_val);
    getFilteringBody(1);
});

$(document).on('keyup', '.from_price, .to_price', function(e) {
    var from_price = $('.from_price').val();
    var to_price = $('.to_price').val();
    if(from_price!="" && to_price!=""){
        if(from_price<to_price){
            getFilteringBody(1);
        }
    }
});

function getFilteringBody(page){
    var product_cat_ids = [];
    var option_value_ids = [];
    var product_theme_ids = [];

    $("input:checkbox[name=product_cat]:checked").each(function(){
        product_cat_ids.push($(this).val());
    });

    $("input:checkbox[name=option_value]:checked").each(function(){
        option_value_ids.push($(this).val());
    });

    $("input:checkbox[name=product_theme]:checked").each(function(){
        product_theme_ids.push($(this).val());
    });

    var fitting_type_id = $('input[name="fitting_type"]:checked').val();
    var product_gender_id = $('input[name="product_gender"]:checked').val();
    var product_stock = $('input[name="product_stock"]:checked').val();

    var from_price = $('.from_price').val();
    var to_price = $('.to_price').val();
    var order_by = $('.order_by_desktop').val();

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('filtering_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, product_cat_ids:product_cat_ids, option_value_ids:option_value_ids, fitting_type_id:fitting_type_id, product_theme_ids:product_theme_ids, product_gender_id:product_gender_id, product_stock:product_stock, from_price:from_price, to_price:to_price, order_by:order_by},
        success: function (data) { 
            $('.product_list').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }
    }); 

    
}


</script>
@endpush