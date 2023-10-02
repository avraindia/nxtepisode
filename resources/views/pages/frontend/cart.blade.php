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
            <div class="cart-body">
            @include('pages.frontend.cart-child') 
            </div>
            <div class="product-details-faq-section">
                <div class="faq-blocks">
                    <ul class="faq-tab">
                        <li>
                            <a href="javascript:void(0);">YOU MAY ALSO LIKE<i class="fa fa-angle-down angel" aria-hidden="true"></i></a>
                            <div class="faq-content">
                                <div class="owl-carousel other-product-slider owl-theme">
                                    <div class="item">
                                        <div class="product-details-section">
                                            <a href="#">
                                                <div class="product-filter-product-image">
                                                    <img src="assets/images/product-image1.png" alt="">
                                                </div>
                                                <div class="product-filter-product-image-name-text">
                                                    <h5>Spider-Man: Spidey Doodle Set</h5>
                                                </div>
                                                <div class="product-filter-product-image-details-text">
                                                    <h6>Boys Cotton Co-ord Sets</h6>
                                                </div>
                                                <div class="product-image-price-section">
                                                    <span class="offer-price">₹ 805</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product-details-section">
                                            <a href="#">
                                                <div class="product-filter-product-image">
                                                    <img src="assets/images/product-image2.png" alt="">
                                                </div>
                                                <div class="product-filter-product-image-name-text">
                                                    <h5>Spider-Man: Spidey Doodle Set</h5>
                                                </div>
                                                <div class="product-filter-product-image-details-text">
                                                    <h6>Boys Cotton Co-ord Sets</h6>
                                                </div>
                                                <div class="product-image-price-section">
                                                    <span class="offer-price">₹ 805</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product-details-section">
                                            <a href="#">
                                                <div class="product-filter-product-image">
                                                    <img src="assets/images/product-image3.png" alt="">
                                                </div>
                                                <div class="product-filter-product-image-name-text">
                                                    <h5>Spider-Man: Spidey Doodle Set</h5>
                                                </div>
                                                <div class="product-filter-product-image-details-text">
                                                    <h6>Boys Cotton Co-ord Sets</h6>
                                                </div>
                                                <div class="product-image-price-section">
                                                    <span class="offer-price">₹ 805</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product-details-section">
                                            <a href="#">
                                                <div class="product-filter-product-image">
                                                    <img src="assets/images/product-image4.png" alt="">
                                                </div>
                                                <div class="product-filter-product-image-name-text">
                                                    <h5>Spider-Man: Spidey Doodle Set</h5>
                                                </div>
                                                <div class="product-filter-product-image-details-text">
                                                    <h6>Boys Cotton Co-ord Sets</h6>
                                                </div>
                                                <div class="product-image-price-section">
                                                    <span class="offer-price">₹ 805</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
    if (confirm("Do you want to remove book from cart?") == true) {
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