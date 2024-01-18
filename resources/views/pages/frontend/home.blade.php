@extends('layouts.front')
@section('content')
<!-- <-----------------Banner section start--------------->
<section class="home-page-banner-slider">    
    <div class="owl-carousel main-banner-slider owl-theme">
        @foreach($top_banner_images as $top_banner_image)
        <div class="item">
            <div class="home-page-main-banner">
                <div class="main-banner-image">
                    <img src="{{ $top_banner_image->homepage_banner_link }}" alt="">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!--
    Ratio A => UNMISSABLE COLLECTION
    Ratio B => SHOP BY THEMES
    Ratio C => STRAIGHT FORM HOLLYWOOD
    Ratio D => TRENDING CATEGORIES
-->
@foreach($sections as $section)
    @php
    $section_type = $section->section_type;
    $image_ratio = $section->image_ratio;
    $section_products = $section->section_products;
    $section_collection = $section->section_collection;
    @endphp

    @if ($section_type == 'collection')
        @if ($image_ratio == 'A')
        <section class="unmissable-collection 01">
            <div class="container">
                <div class="unmissable-collection-header-text">
                    <h4>{{$section->section_name}}</h4>
                </div>
                <div class="unmissable-collection-image-section">
                    <div class="row">
                        <div class="owl-carousel unmissable-collection-image-slider  owl-theme">
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
        </section>
        @endif

        @if ($image_ratio == 'B')
        <section class="shop-by-theme-section 03">
            <div class="container">
                <div class="shop-by-theme-section-header-text">
                    <h4>{{$section->section_name}}</h4>
                </div>
                <div class="shop-by-theme-image-section">
                    <div class="row g-lg-4 g-3">
                        @foreach($section_collection as $collection)
                        <?php
                            $collection_id = base64_encode($collection->id);
                        ?>
                        <div class="col-md-6 col-6">
                            <div class="shop-by-theme-image">
                                <a href="{{route('products',['col' => $collection_id])}}">
                                    <img src="{{$collection->section_image_link}}" alt="">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if ($image_ratio == 'C')
        <section class="straight-form-hollywood-section 04">
            <div class="container">
                <div class="straight-form-hollywood-section-header-text">
                    <h4>{{$section->section_name}}</h4>
                </div>
                <div class="straight-form-hollywood-image-section">
                    <div class="row">
                        <div class="owl-carousel straight-form-hollywood-image-slider  owl-theme">
                            @foreach($section_collection as $collection)
                            <?php
                            $collection_id = base64_encode($collection->id);
                            ?>
                            <div class="item">
                                <div class="straight-form-hollywood-image-section">
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
        </section>
        @endif

        @if ($image_ratio == 'D')
        <section class="trending-categories-section 05">
            <div class="container">
                <div class="trending-categories-section-header-text">
                    <h4>{{$section->section_name}}</h4>
                </div>
                <div class="trending-categories-section-image-section">
                    <div class="row g-lg-4 g-3">
                        @foreach($section_collection as $collection)
                        <?php
                            $collection_id = base64_encode($collection->id);
                        ?>
                        <div class="col-md-6 col-6">
                            <div class="trending-categories-image">
                                <a href="{{route('products',['col' => $collection_id])}}">
                                    <img src="{{$collection->section_image_link}}" alt="">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endif

    @if ($section_type == 'product')
    <section class="trending-near-section 02">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trending-near-section-header-text">
                        <h4>{{$section->section_name}}</h4>
                    </div>
                </div>
                <div class="trending-near-section-more-product-btn">
                    <a href="{{route('products')}}">Show More</a>
                </div>
                <div class="trending-near-product-slider-section">
                    <div class="owl-carousel trending-near-product-list-slider owl-theme">
                        @foreach($section->section_products as $section_product)
                        @php
                        $product_details = $section_product->product_details;
                        $parent_product_details = $product_details->parent_product_details;
                        $product_mrp = $parent_product_details->product_mrp;
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
                        ?>
                        @foreach($product_details->gallery_images as $image)
                            @php
                            $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                            @endphp
                            @break
                        @endforeach
                        
                        <div class="item">
                            <div class="product-details-section">
                                <a href="{{route('front_product_details',base64_encode($product_details->id))}}">
                                    <div class="product-filter-product-image">
                                        <img src="{{$product_thumbnail_image_link}}" alt="">
                                    </div>
                                    <div class="product-filter-product-image-name-text">
                                        <h5>{{$product_details->fitting_title}}</h5>
                                    </div>
                                    <div class="product-filter-product-image-details-text">
                                        <h6>{{$product_details->fitting_name->type_name}} for {{$product_details->product_gender->gender}}</h6>
                                    </div>
                                    <div class="product-image-price-section">
                                        <span class="offer-price">₹ {{$amount_after_gst}}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endforeach
<!-- <----------------- section start--------------->
<section class="best-of-nxt-episode-section">
    <div class="container">
        <div class="best-of-nxt-episode-section-header-text">
            <h4>Best of NXT Episode</h4>
        </div>
    </div>
    <div class="best-of-nxt-episode-slider-section">
        <div class="owl-carousel best-of-nxt-episode-image-slider owl-theme">
            @foreach($foot_banner_images as $foot_banner_images)
            <div class="item">
                <div class="best-of-nxt-episode-slider-image">
                    <a href="javascript:void(0);"><img src="{{ $foot_banner_images->homepage_banner_link }}" alt=""></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->

@stop

@push('scripts')
<script>
</script>
@endpush