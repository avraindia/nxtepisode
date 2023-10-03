@extends('layouts.front')
@section('content')
<style>

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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">Payment</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="section-top-select-text checkout-section-top-select-section">
    <div class="container">
        <div class="section-select-top-ul-section">
            <div class="row justify-content-lg-center">
                <div class="col-md-12">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="section-top-select-ul-selection">
                                <ul>
                                    <li class="active-select-ul">MY BAG</li>
                                    <span>- - - - - - - - - - - - -</span>
                                    <li class="active-select-ul">ADDRESS</li>
                                    <span>- - - - - - - - - - - - -</span>
                                    <li class="active-select-ul">PAYMENT</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="delivery-to-address-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="confirm-order-delivery-address">
                    <div class="confirm-order-delivery-address-change-btn">
                        <a href="javascript:void(0);" class="change_delivery_address_btn">CHANGE</a>
                    </div>
                    <div class="delivery-text">
                        <h5>Deliver To: {{$checked_address->first_name}} {{$checked_address->last_name}}, {{$checked_address->postal_code}}</h5>
                        <p>{{$checked_address->house_no}} {{$checked_address->street_name}}, {{$checked_address->city_district}}, {{$checked_address->landmark}} </p>
                    </div>
                    <div class="saved_delivery_address" style="display:none;">
                        <ul>
                            @foreach ($addresses as $address)
                            <li>                                
                                <div class="checkout-suggest-address">
                                    <label for="online-payment">
                                        <input class="radioshow_address" type="radio" id="online-address" name="payment" data-class="div{{$address->id}}" value="{{$address->id}}" @if($address->id == $address_id) checked  @endif>
                                        <span>
                                        <div class="suggest-delivery-text">
                                        <h5>Deliver To: {{$address->first_name}} {{$address->last_name}}, {{$address->postal_code}}</h5>
                                        <p>{{$address->house_no}} {{$address->street_name}}, {{$address->city_district}}, {{$address->landmark}} </p>
                                        </div>
                                        </span>
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="confirm-order-payment-option-section">
                    <div class="confirm-order-payment-option-header-text">
                        <h5>Payment Options</h5>
                    </div>
                    <div class="billing-price-section">
                        <ul>
                            <li>                                
                                <div class="checkout-address-details-total-section">
                                    <label for="online-payment">
                                        <input class="radioshow" type="radio" id="online-payment" name="payment"
                                            data-class="div1">
                                        <span>
                                            <div class="address-details-section">
                                                <h6>Online Payment</h6>
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </li>
                            <li>                                
                                <div class="checkout-address-details-total-section">
                                    <label for="cod-payment">
                                        <input class="radioshow" type="radio" id="cod-payment" name="payment"
                                            data-class="div2">
                                        <span>
                                            <div class="address-details-section">
                                                <h6>COD</h6>
                                            </div>
                                        </span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="place-order-section">
                    <div class="billing-details">
                        <div class="billing-details-header-text">
                            <h5>BILLING DETAILS</h5>
                        </div>
                        <div class="billing-price-section">
                            <ul>
                                <li>Cart Total <span class="price-text">₹ {{$total_price}}</span></li>
                                <li>Discount <span class="discount-text">- ₹ {{$discount}}</span></li>
                                <li>Shipping Charges <span class="shipping-text">₹ {{$shipping_fee}}</span></li>
                                <li>Total Amount <span class="price-text">₹ {{$final_amount}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <a href="javascript:void(0);" class="confirm_order">Confirm Order</a>
                        <form id="submitForm" action="{{ route('order') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="shipping_fee" class="shipping_fee" value="{{$shipping_fee}}">
                            <input type="hidden" name="total_price" class="total_price" value="{{$total_price}}">
                            <input type="hidden" name="discount" class="discount" value="{{$discount}}">
                            <input type="hidden" name="promocode_id" class="promocode_id" value="{{$promocode_id}}">
                            <input type="hidden" name="final_amount" class="final_amount" value="{{$final_amount}}">
                            <input type="hidden" name="address_id" class="address_id" value="{{$address_id}}">
                        </form>
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
$(document).on('click', '.change_delivery_address_btn', function(e) {
    $('.saved_delivery_address').slideToggle();
});

$(document).on('click', '.radioshow_address', function(e) {
    var address_id = $(this).val();
    $('.address_id').val(address_id);
    var inner_html = $(this).closest('.checkout-suggest-address').find(".suggest-delivery-text").html();
    $('.delivery-text').html(inner_html);

    setTimeout(function () {
        $('.saved_delivery_address').slideToggle();
    }, 200);
});

$(document).on('click', '.confirm_order', function(e) {
    const theForm = $('#submitForm');
    theForm.submit();
});
</script>
@endpush