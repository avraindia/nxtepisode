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
                        <a href="javascript:void(0);">CHANGE</a>
                    </div>
                    <div class="delivery-text">
                        <h5>Deliver To: Saswata Roy Chowdhury, 743145</h5>
                        <p>67 Rajani Babu Road, Kanchrapara,  Rajani Babu Road,  Kanchrapara,  Kanchrapara </p>
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
                                <li>Cart Total <span class="price-text">₹ 999.05</span></li>
                                <li>Discount <span class="discount-text">- ₹ 100.00</span></li>
                                <!-- <li>GST <span class="gst-text">₹ 44.95</span></li> -->
                                <li>Shipping Charges <span class="shipping-text">₹ 0</span></li>
                                <li>Total Amount <span class="price-text">₹ 944.00</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <a href="#">Confirm Order</a>
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

</script>
@endpush