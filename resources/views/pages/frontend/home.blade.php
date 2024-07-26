@extends('layouts.front')
@section('content')
<!--
A => Slider with 1 image (Page Top Slider) (Type - Collection)
B => Slider with 3 square images (Type - Collection)
C => Slider with 4 horizontally rectangle images (Type - Collection)
D => Slider with 4 rectangle images with ordering number(e.g. Top 5 or Top 10) (Type - Collection)
E => Slider with 4 square images without title (Type - Collection)
F => Slider with 4 circle images (Type - Collection)
G => Slider with 1 image (Type - Product)
H => Slider with 5 rectangle images (Type - Product)
I => Slider with 5 rectangle images of flash sale (Type - Product)
J => Slider with 4 square images with title (Type - Collection)
K => Slider with 4 vertically rectangle images (Type - Collection)
L => Slider with 1 image (Page Middle Slider) (Type - Collection)
-->
@php
    $i = 1;
@endphp    
@foreach($sections as $section)
    @php
    $section_type = $section->section_type;
    $image_ratio = $section->image_ratio;
    $section_products = $section->section_products;
    $section_collection = $section->section_collection;
    @endphp

    @if ($section_type == 'collection')
        @if ($image_ratio == 'A')
            <!-- <-----------------Banner section start--------------->
            <section class="top-banner-slider-section">
                <div class="owl-carousel top-banner-slider owl-theme">
                    @foreach($section_collection as $collection)
                    <?php
                    $collection_id = base64_encode($collection->id);
                    ?>
                    <div class="item">
                        <div class="home-page-main-banner">
                            <div class="main-banner-image">
                                <a href="{{route('products',['col' => $collection_id])}}">
                                    <img src="{{$collection->section_image_link}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($image_ratio == 'B')
            <!-- <----------------- section start--------------->
            <section class="unmissable-collection 01">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="unmissable-collection-header-text">
                                <h4>{{$section->section_name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="unmissable-collection-slider-section">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="unmissable-collection-image-section">
                                    <div class="owl-carousel unmissable-collection-image-slider owl-theme">
                                        @foreach($section_collection as $collection)
                                        <?php
                                        $collection_id = base64_encode($collection->id);
                                        ?>
                                        <div class="item">
                                            <div class="unmissable-collection-image">
                                                <a href="{{route('products',['col' => $collection_id])}}">
                                                    <img src="{{$collection->section_image_link}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'C')
            <!-- <----------------- section start--------------->
            <section class="recently-added-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tune-up-buddy-product-section">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel recently-added-product-slider owl-theme">
                                    @foreach($section_collection as $collection)
                                    <?php
                                    $collection_id = base64_encode($collection->id);
                                    ?>
                                    <div class="item">
                                        <div class="recently-added-product-image">
                                            <a href="{{route('products',['col' => $collection_id])}}">
                                                <img src="{{$collection->section_image_link}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'D')
            <!-- <----------------- section start--------------->
            <section class="top-ten-this-week-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-ten-this-week-section-slider-total-section">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel top-ten-this-week-image-slider owl-theme">
                                    @foreach($section_collection as $collection)
                                    <?php
                                    $collection_id = base64_encode($collection->id);
                                    ?>
                                    <div class="item">
                                        <div class="top-ten-this-week-image">
                                            <a href="{{route('products',['col' => $collection_id])}}">
                                                <div class="top-ten-number-text">
                                                    <h3>{{$collection->item_order}}</h3>
                                                </div>
                                                <img src="{{$collection->section_image_link}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'E')
            <!-- <----------------- section start--------------->
            <section class="shop-by-theme-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-by-theme-product-image">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel shop-by-theme-image-slider owl-theme">
                                @php
                                    $tr1 = 0;
                                @endphp  
                                
                                @foreach($section_collection as $collection)
                                    <?php
                                    if($tr1 == 0){
                                        echo '<div class="item"><div class="shop-by-theme-image-section"><div class="row g-lg-3 g-3 justify-content-center">';
                                    }
                                    $collection_id = base64_encode($collection->id);
                                    ?>
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-6 shop-by-theme-product-image-col-section">
                                        <div class="shop-by-theme-image">
                                            <a href="{{route('products',['col' => $collection_id])}}">
                                                <img src="{{$collection->section_image_link}}"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    if($tr1 == 3){
                                        echo '</div></div></div>';
                                        $tr1 = 0;
                                    }else{
                                        $tr1 = $tr1+1;
                                    }
                                    ?>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'F')
            <!-- <----------------- section start--------------->
            <section class="shop-by-theme-section shop-by-theme-round-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-by-theme-product-image">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel shop-by-theme-circle-image-slider owl-theme">
                                    @foreach($section_collection as $collection)
                                    <?php
                                    $collection_id = base64_encode($collection->id);
                                    ?>
                                    <div class="item">
                                        <div class="crew-member-image-name">
                                            <a href="{{route('products',['col' => $collection_id])}}">
                                                <div class="crew-member-image">
                                                    <img src="{{$collection->section_image_link}}" alt="">
                                                </div>
                                                <div class="shop-by-theme-round-image-category-name">
                                                    <h5>{{$collection->item_name}}</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'J')
            <!-- <----------------- section start--------------->
            <section class="trending-categories-section 05">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="trending-categories-section-image-section">
                    <div class="container-fluid">
                        <div class="owl-carousel trending-categories-image-slider owl-theme">
                            @php
                                $tr = 0;
                            @endphp  
                              
                            @foreach($section_collection as $collection)
                                <?php
                                if($tr == 0){
                                    echo '<div class="item"><div class="row g-lg-3 g-2 justify-content-center">';
                                }
                                $collection_id = base64_encode($collection->id);
                                ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="trending-categories-image">
                                        <a href="{{route('products',['col' => $collection_id])}}">
                                            <div class="trending-categories-image-text">
                                                <h5>{{$collection->item_name}}</h5>
                                            </div>
                                            <img src="{{$collection->section_image_link}}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <?php
                                if($tr == 3){
                                    echo '</div></div>';
                                    $tr = 0;
                                }else{
                                    $tr = $tr+1;
                                }
                                ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif
        
        @if ($image_ratio == 'K')
            <!-- <----------------- section start--------------->
            <section class="popular-categories-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="straight-form-hollywood-image-section">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel popular-categories-image-slider  owl-theme">
                                    @foreach($section_collection as $collection)
                                    <?php
                                    $collection_id = base64_encode($collection->id);
                                    ?>
                                    <div class="item">
                                        <div class="popular-categories-image-section">
                                            <a href="{{route('products',['col' => $collection_id])}}">
                                                <img src="{{$collection->section_image_link}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'L')
            <!-- <----------------- section start--------------->
            <section class="the-boys-club-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="best-of-nxt-episode-slider-section">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel the-boys-club-image-slider owl-theme">
                                    @foreach($section_collection as $collection)
                                    <?php
                                    $collection_id = base64_encode($collection->id);
                                    ?>
                                    <div class="item">
                                        <div class="the-boys-club-slider-image">
                                            <a href="{{route('products',['col' => $collection_id])}}">
                                                <img src="{{$collection->section_image_link}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif
    @endif

    @if ($section_type == 'product')
        @if ($image_ratio == 'G')
            <!-- <----------------- section start--------------->
            <section class="next-episode-x-ray-section">
                <div class="next-episode-x-ray-banner-image">
                    <img src="{{ asset('frontend/images/nxt-episode-x-ray-banner-image.png') }}" alt="">
                </div>
                <div class="next-episode-x-ray-section-product">
                    <div class="owl-carousel next-episode-x-ray-section-product-slider owl-theme">
                        @foreach($section->section_products as $section_product)
                        @foreach($product_details->gallery_images as $image)
                            @php
                            $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                            @endphp
                            @break
                        @endforeach
                        <div class="item">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <div class="next-episode-x-ray-section-product-image">
                                            <img src="{{$product_thumbnail_image_link}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-6">
                                        <div class="next-episode-x-ray-section-product-details-text">
                                            <h4>{{$product_details->fitting_title}}</h4>
                                            <h5>Launch Date: 08.05.2023 <br>
                                            {{$product_details->fitting_name->type_name}} for {{$product_details->product_gender->gender}}</h5>
                                            <p>{!! $product_details->details !!}</p>
                                        </div>
                                        <div class="col-4 for-desktop">
                                            <div class="next-episode-x-ray-section-order-now-btn">
                                                <a href="{{route('front_product_details',base64_encode($product_details->id))}}">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 for-responsive">
                                        <div class="next-episode-x-ray-section-order-now-btn">
                                            <a href="{{route('front_product_details',base64_encode($product_details->id))}}">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->                               
        @endif

        @if ($image_ratio == 'H')
            <!-- <----------------- section start--------------->
            <section class="trending-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="category-name-more-btn-section">
                                <div class="unmissable-collection-header-text">
                                    <h4>{{$section->section_name}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="trending-near-you-slider-total-section">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-12 unmissable-collection-col-section">
                                <div class="owl-carousel trending-near-product-list-slider owl-theme">
                                    @foreach($section->section_products as $section_product)
                                    @php
                                    $product_details = $section_product->product_details;
                                    $parent_product_details = $product_details->parent_product_details;
                                    $product_mrp = $parent_product_details->product_mrp;
                                    $market_price = $parent_product_details->market_price;
                                    $product_gst = $parent_product_details->gst;
                                    @endphp
                                    <?php
                                    if($product_gst == 0){
                                        $product_gst = $global_gst;
                                    }
                                    $gst_amount = ($product_mrp*$product_gst)/100;
                                    $gst_amount = round($gst_amount);
                                    $amount_after_gst = $product_mrp+$gst_amount;
                                    $amount_after_gst = $amount_after_gst.'.00';

                                    // $market_price_gst_amount = ($market_price*$product_gst)/100;
                                    // $market_price_gst_amount = round($market_price_gst_amount);
                                    // $amount_after_market_price_gst = $market_price+$market_price_gst_amount;
                                    // $amount_after_market_price_gst = $amount_after_market_price_gst.'.00';
                                    $amount_after_market_price_gst = 0;
                                    ?>
                                    @foreach($product_details->gallery_images as $image)
                                        @php
                                        $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                                        @endphp
                                        @break
                                    @endforeach
                                    <div class="item">
                                        <div class="trending-near-you-product-slider">
                                            <a href="{{route('front_product_details',base64_encode($product_details->id))}}">
                                                <div class="trending-near-you-product-slider-image">
                                                    <img src="{{$product_thumbnail_image_link}}" alt="">
                                                </div>
                                                
                                                <div class="product-name-price-text-total-section">
                                                    <div class="product-name-text">
                                                        @php 
                                                        $truncated_title = Str::of($product_details->fitting_title)->limit(15);
                                                        @endphp
                                                        <h5>{{$truncated_title}}</h5>
                                                        <h6>{{$product_details->fitting_name->type_name}} for {{$product_details->product_gender->gender}}</h6>
                                                    </div>
                                                    <div class="price-text">
                                                        <span class="price-number-text">₹{{$amount_after_gst}}</span>
                                                        <!-- <span class="price-cancel-text">₹899</span>
                                                        <span class="offer-price-text">10%OFF</span> -->
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

        @if ($image_ratio == 'I') 
            <!-- <----------------- section start--------------->
            <section class="flash-sale-section">
                <div class="flash-sale-title-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="unmissable-collection-header-text">
                                    <h4>FLASH <span class="flash-icon"><i class="fa-solid fa-bolt"></i></span> SALE</h4>
                                    <h6>Discounted Price Valid Only For</h6>
                                    <div class="timer-image">
                                        <img src="{{ asset('frontend/images/timer-image.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="trending-near-you-slider-total-section">
                        <div class="container-fluid">
                            <div class="row justify-content-end">
                                <div class="col-12 unmissable-collection-col-section">
                                    <div class="owl-carousel trending-near-product-list-slider owl-theme">
                                        @foreach($section->section_products as $section_product)
                                        @php
                                        $product_details = $section_product->product_details;
                                        $parent_product_details = $product_details->parent_product_details;
                                        $product_mrp = $parent_product_details->product_mrp;
                                        $market_price = $parent_product_details->market_price;
                                        $product_gst = $parent_product_details->gst;
                                        @endphp
                                        <?php
                                        if($product_gst == 0){
                                            $product_gst = $global_gst;
                                        }
                                        $gst_amount = ($product_mrp*$product_gst)/100;
                                        $gst_amount = round($gst_amount);
                                        $amount_after_gst = $product_mrp+$gst_amount;
                                        $amount_after_gst = $amount_after_gst.'.00';

                                        // $market_price_gst_amount = ($market_price*$product_gst)/100;
                                        // $market_price_gst_amount = round($market_price_gst_amount);
                                        // $amount_after_market_price_gst = $market_price+$market_price_gst_amount;
                                        // $amount_after_market_price_gst = $amount_after_market_price_gst.'.00';
                                        $amount_after_market_price_gst = 0;
                                        ?>
                                        @foreach($product_details->gallery_images as $image)
                                            @php
                                            $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                                            @endphp
                                            @break
                                        @endforeach
                                        <div class="item">
                                            <div class="trending-near-you-product-slider">
                                                <a href="{{route('front_product_details',base64_encode($product_details->id))}}">
                                                    <div class="trending-near-you-product-slider-image">
                                                        <img src="{{$product_thumbnail_image_link}}" alt="">
                                                    </div>
                                                    <div class="product-name-price-text-total-section">
                                                        <div class="product-name-text">
                                                            @php 
                                                            $truncated_title = Str::of($product_details->fitting_title)->limit(15);
                                                            @endphp
                                                            <h5>{{$truncated_title}}</h5>
                                                            <h6>{{$product_details->fitting_name->type_name}} for {{$product_details->product_gender->gender}}</h6>
                                                        </div>
                                                        <div class="price-text">
                                                            <span class="price-number-text">₹{{$amount_after_gst}}</span>
                                                            <!-- <span class="price-cancel-text">₹899</span>
                                                            <span class="offer-price-text">10%OFF</span> -->
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="product-explore-btn">
                                        <a href="#">EXPLORE ALL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <----------------- section End--------------->
        @endif

    @endif

    @if ($i == 1)
        <!-- <----------------- section start--------------->
        <section class="shipping-procces-image-section">
            <div class="shipping-procces-image">
                <img src="{{asset('frontend/images/shipping-image.png')}}" alt="">
            </div>
        </section>

        <!-- <----------------- section End--------------->
        <!-- <----------------- section start--------------->
        <section class="discount-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="discount-section-text">
                            <p>PUJO COLLECTIONS COMING SOON</p>
                            <h5>BOOK NOW GET 5% FLAT DISCOUNT</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <----------------- section End--------------->
    @endif

    @if ($i == 11)
        <!-- <----------------- section start--------------->
        <section class="ad-space-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ad-space-section-image">
                            <img src="{{ asset('frontend/images/add-image.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <----------------- section End--------------->                                
    @endif
    @php
    $i = $i+1;
    @endphp
@endforeach

<!-- <----------------- section start--------------->
<section class="review-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="category-name-more-btn-section">
                    <div class="unmissable-collection-header-text">
                        <h4>In Review</h4>
                        <h5>public opinion about us</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="review-image-text-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel review-image-text-slider owl-theme">
                        @foreach($opinions as $opinion)
                        <div class="item">
                            <div class="review-card-section">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="review-image">
                                            <img src="{{$opinion->public_opinion_image_link}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="review-text">
                                            <p>{{$opinion->public_opinion}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <----------------- section End--------------->
<section class="india-brand-section">
    <div class="discount-section-text">
        <h5>HOMEGROWN INDIAN BRAND</h5>
    </div>
    <div class="happy-customers-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="happy-customers-section-text">
                        <h5>Over <span>6 Million</span> Happy Customers</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('scripts')
<script>
</script>
@endpush