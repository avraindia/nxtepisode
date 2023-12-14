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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">Order Success</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="product-cart-section order-success-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="cart-image-text-total-section">
                    <div class="row g-md-3">
                        <div class="col-md-12">
                            <div class="order-success-image-text-total-section">
                                <div class="order-succesful-image">
                                    <img src="{{ asset('frontend/images/successful.png') }}" alt="">
                                </div>
                                
                                <div class="order-succesful-text-image">
                                    <h4>Order Succesful!</h4>
                                    <h6>Order No. <span class="oreder-number-text">{{$order_details->order_number}}</span></h6>
                                    <p>A confirmation email has been sent to you!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="your-information-details">
                                <div class="information-head-text">
                                    <h5>Your Information</h5>
                                </div>
                                <div class="information-text">
                                    <h6>{{$order_details->user_details->full_name}}</h6>
                                    <p>Email : {{$order_details->user_details->email}}</p>
                                    @if ($order_details->user_details->phone_number != "")
                                        <p>Mobile : {{$order_details->user_details->phone_number}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="your-information-details">
                                <div class="information-head-text">
                                    <h5>Payment Method</h5>
                                </div>
                                <div class="information-text">
                                    <h6>{{$order_details->payment_type}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="your-information-details">
                                <div class="information-head-text">
                                    <h5>Shipping Address</h5>
                                </div>
                                <div class="information-text">
                                    <h6>{{$order_details->shipping_address->first_name}} {{$order_details->shipping_address->last_name}}</h6>
                                    <p>{{$order_details->shipping_address->house_no}} {{$order_details->shipping_address->street_name}},</p>
                                    <p>{{$order_details->shipping_address->landmark}},</p> 
                                    <p>{{$order_details->shipping_address->city_district}} - {{$order_details->shipping_address->postal_code}}     
                                    </p>
                                    <p>{{$order_details->shipping_address->state_name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="place-order-section">
                    <div class="billing-details">
                        <div class="billing-details-header-text">
                            <h5>TOTAL AMOUNT</h5>
                        </div>
                        <div class="billing-price-section">
                            <ul>
                                <li>Cart Total <span class="price-text">₹ {{$order_details->order_price}}</span></li>
                                <li>Discount <span class="discount-text">- ₹ {{$order_details->discount}}</span></li>
                                <!-- <li>GST <span class="gst-text">₹ 44.95</span></li> -->
                                <li>Shipping Charges <span class="shipping-text">₹ {{$order_details->shipping_fee}}</span></li>
                                <li>Total Amount <span class="price-text">₹ {{$order_details->final_price}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <a href="{{route('order_details',base64_encode($order_details->id))}}">go to order details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="place-order-btn continue-shopping-btn">
                    <a href="{{route('products')}}">continue shopping</a>
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