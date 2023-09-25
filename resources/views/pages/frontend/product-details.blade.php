@extends('layouts.front')
@section('content')
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 20px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #222;
        background-color: #ccc;
    }
    .product_type{
        width: 80px !important;
    }
    .no_size{
        text-decoration: line-through;
        border: 2px solid #b1bbcd !important;
    }
</style>

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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">{{$product_details->fitting_title}}</h1>
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
        <div class="row g-md-5">
            <div class="col-lg-7 col-md-6">
                <div class="product-details-image-section">
                    <div class="owl-carousel product-details-image-slider owl-theme">
                        @foreach($product_details->gallery_images as $key=>$product_image)
                        <div class="item">
                            <div class="product-details-image">
                                <img src="{{$product_image->product_details_image_link}}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="product-details-text">
                    <div class="product-details-header-text">
                        <h5>{{$product_details->fitting_title}}</h5>
                    </div>
                    <div class="prod-cat-text">
                        <a href="javascript:void(0);">{{$product_details->cat_name}}</a>
                    </div>
                    <div class="product-image-price-section">
                        <span class="offer-price">₹ {{$product_details->product_mrp}}</span>
                        <input type="hidden" name="default_mrp" class="default_mrp" value="{{$product_details->product_mrp}}">
                        <!-- <span class="product-price">₹ 1048</span>
                        <span class="percentage-off">23% OFF</span> -->
                    </div>

                    <div class="select-the-size-btn">
                        <span>Please select a size. </span>
                        <!-- <a href="#">SIZE CHART</a> -->
                    </div>
                    
                    <div class="size-select-btn">
                        @foreach($sizes as $size)
                        <label>
                            <input type="radio" name="size_id" class="size_id" value="{{$size->id}}" @if(!in_array($size->id, $size_ids)) disabled  @endif>
                            <span @if(!in_array($size->id, $size_ids)) class="no_size"  @endif>{{$size->option_value}}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="alert size_resp" style="display:none;"></div>
                    <!-- <div class="select-the-size-btn size-notify-btn">
                        <span>Size not available?</span>
                        <a href="#">Notify Me</a>
                    </div> -->

                    <div class="product-quantity-section">
                        <h6>Quantity :</h6>
                        <div class="qty-input">
                            <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                            <input class="product-qty" type="number" name="product-qty" min="1" max="10" value="1">
                            <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                        </div>
                    </div>

                    <div class="add-to-cart-add-to-wishlist-btn">
                        <div class="row g-md-3">
                            <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                <div class="add-to-cart-btn">
                                    <a href="javascript:void(0);" class="add_to_cart">Add to cart</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                <div class="add-to-wishlist-btn">
                                    <a href="javascript:void(0);" class="add_to_wishlist"><i class="fa-sharp fa-light fa-heart"></i> &nbsp;Add to Wishlist</a>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" class="product_id" value="{{$product_details->product_id}}">
                            <input type="hidden" name="cart_available" class="cart_available" value="no">
                            <input type="hidden" name="variation_id" class="variation_id" value="{{$product_details->id}}">
                            <input type="hidden" name="product_stock" class="product_stock" value="0">
                        </div>
                    </div>

                    <div class="share-social-media-section">
                        <h6>Share :</h6>
                        <div class="social-media-link">
                            {!! $shareComponent !!}
                        </div>
                    </div>

                    <div class="product-details-faq-section">
                        <div class="faq-blocks">
                            <ul class="faq-tab">
                                <li>
                                    <a href="javascript:void(0);">Product Details<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div class="faq-content">
                                        <div class="material-care-section">
                                        {!! $product_details->details !!}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Product Description<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div class="faq-content">
                                        <div class="material-care-section">
                                            {!! $product_details->description !!}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->
@stop

@push('scripts')
<script>
$(document).on('change', '.size_id', function(e) {
    $('.cart_available').val('no');
    $('.product_stock').val('0');

    var default_mrp = $('.default_mrp').val();
    $('.offer-price').html('₹ '+default_mrp);

    $('.size_resp').removeClass('alert-danger').html('');
    $('.size_resp').hide();

    var size_id = $('input[name="size_id"]:checked').val();
    var product_id = $('.product_id').val();

    if (typeof size_id !== "undefined") {
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('check_variation_exists') }}",
            method: 'POST',
            data: {_token: _token, size_id:size_id, product_id:product_id},
            success: function (data) { 
                if(data.status == true){
                    if(data.num != '0'){
                        var inventory_rec = data.inventory_rec;
                        $('.cart_available').val('yes');
                        $('.product_stock').val(inventory_rec.current_stock);

                        if(inventory_rec.inventory_price!='0.00'){
                            $('.offer-price').html('₹ '+inventory_rec.inventory_price);
                        }
                    }
                }
            }
        }); 
    }
});

$(document).on('click', '.add_to_cart', function(e) {
    var valid = true;
    var size_id = $('input[name="size_id"]:checked').val();

    if (typeof size_id === "undefined") {
        $('.size_resp').addClass('alert-danger').html('Please select a size.');
        $('.size_resp').show();
        valid = false;
    }else{
        $('.size_resp').removeClass('alert-danger').html('');
        $('.size_resp').hide();
    }
    
});


</script>
@endpush