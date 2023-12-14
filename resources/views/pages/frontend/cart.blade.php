@extends('layouts.front')
@section('content')
<style>
.empty-content {
    text-align: center;
}

.empty-content img{
    margin-bottom: 20px;
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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="section-top-select-text">
    <div class="container">
        <div class="section-select-top-ul-section">
            <div class="row justify-content-lg-center">
                <div class="col-md-12">
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <div class="section-top-select-ul-selection">
                                <ul>
                                    <li class="active-select-ul">MY BAG</li>
                                    <span>- - - - - - - - - - - - -</span>
                                    <li>ADDRESS</li>
                                    <span>- - - - - - - - - - - - -</span>
                                    <li>PAYMENT</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-cart-section">
    <div class="container">
        <div class="row">
            @if (\Session::has('successmsg'))
            <div class="alert alert-success">
                {!! \Session::get('successmsg') !!}
            </div>
            @endif
            <div class="row cart-body">
            @include('pages.frontend.cart-child') 
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="product-details-faq-section">
                        <div class="faq-blocks">
                            <ul class="faq-tab">
                                <li>
                                    <a href="javascript:void(0);">YOU MAY ALSO LIKE<i class="fa fa-angle-down angel" aria-hidden="true"></i></a>
                                    <div class="faq-content">
                                        <div class="owl-carousel other-product-slider owl-theme">
                                            @foreach ($similar_products as $product)
                                            <div class="item">
                                                <div class="product-details-section">
                                                    <a href="{{route('front_product_details',base64_encode($product->id))}}">
                                                        <div class="product-filter-product-image">
                                                        @foreach($product->gallery_images as $image)
                                                            @php
                                                            $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                                                            @endphp
                                                            @break
                                                        @endforeach
                                                            <img src="{{$product_thumbnail_image_link}}" alt="">
                                                        </div>
                                                        <div class="product-filter-product-image-name-text">
                                                            <h5>{{$product->fitting_title}}</h5>
                                                        </div>
                                                        <div class="product-filter-product-image-details-text">
                                                            <h6>{{$product->fitting_name->type_name}}</h6>
                                                        </div>
                                                        <div class="product-image-price-section">
                                                            <span class="offer-price">₹ {{$product->product_mrp}}</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
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
$(document).on('change', '.cart_item_quantity', function(e) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var quantity = $(this).val();
    var variation_id = $(this).parents('.size-quantity-section').find('input.variation_id').val();
    var product_id = $(this).parents('.size-quantity-section').find('input.product_id').val();
    var size_id = $(this).parents('.size-quantity-section').find('input.size_id').val();

    $.ajax({
        url: "{{ route('cart.update') }}",
        method: 'POST',
        data: {_token: _token, variation_id:variation_id, product_id:product_id, size_id:size_id, quantity:quantity},
        success: function (data) { 
            $('.cart-body').html(data);
            update_cart_number_nav();
        }
    });
});

$(document).on('click', '.remove_from_cart', function(e) {
    if (confirm("Do you want to remove product from cart?") == true) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var pr_id = $(this).attr('pr_id');
    $.ajax({
        url: "{{ route('cart.remove') }}",
        method: 'POST',
        data: {_token: _token, id:pr_id},
        success: function (data) { 
            $('.cart-body').html(data);
            update_cart_number_nav();
        }
    }); 

    }
});

$(document).on('click', '.apply_promo_btn', function(e) {
    $('.promocode_resp').removeClass('alert-success').removeClass('alert-danger').html('').hide();
    $('.is_promocode_applied').val('0');
    $('.discount').val('0.00');
    $('.promocode_id').val('0');
    var full_amount = $('.full_amount').val();
    $('.final_amount').val(full_amount);
    $('.total-amount').html('₹ '+full_amount);

    var promo_code = $('.promo_code').val();
    if(promo_code != ""){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('check_promo_code') }}",
            method: 'POST',
            data: {_token: _token, promo_code:promo_code},
            success: function (data) { 
                if(data.status == true){
                    var promocode_details = data.promocode_details;
                    var discount_in = promocode_details.discount_in;
                    var discount = promocode_details.discount;
                    var promocode_id = promocode_details.id;
                    $('.promocode_id').val(promocode_id);
                    $('.is_promocode_applied').val(1);

                    var total_mrp_price = $('.total_mrp_price').val();
                    var total_price = $('.total_price').val();

                    if(discount_in == 'percentage'){
                        var order_discount = (total_mrp_price*discount)/100;
                        order_discount = Math.trunc( order_discount );
                        order_discount = parseFloat(order_discount).toFixed(2);
                        $('.discount').val(order_discount);
                        $('.discount-text').html('- ₹ '+order_discount);
                        //var final_price = (total_price-order_discount)+parseFloat(shipping_fee);
                        var final_price = (total_price-order_discount);
                        final_price = final_price.toFixed(2);
                        $('.total-amount').html('₹ '+final_price);
                        $('.final_amount').val(final_price);
                    }

                    if(discount_in == 'flat'){
                        var order_discount = Math.trunc( discount );
                        order_discount = parseFloat(order_discount).toFixed(2);
                        $('.discount').val(order_discount);
                        $('.discount-text').html('- ₹ '+order_discount);
                        //var final_price = (total_price-order_discount)+parseFloat(shipping_fee);
                        var final_price = (total_price-order_discount);
                        final_price = final_price.toFixed(2);
                        $('.total-amount').html('₹ '+final_price);
                        $('.final_amount').val(final_price);
                    }
                }else{
                    $('.promocode_resp').addClass('alert-danger').html(data.msg);
                    $('.promocode_resp').show();
                }
            }
        });
    }
});

$(document).on('click', '.place_order', function(e) {
    const theForm = $('#submitForm');
    theForm.submit();
});

function update_cart_number_nav(){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('cart.count') }}",
        data: {_token: _token},
        success: function (data) { 
        var cart_quantity = data.cart_quantity;
        $('.cart_item_num').html(cart_quantity);
        }
    });
}
</script>
@endpush