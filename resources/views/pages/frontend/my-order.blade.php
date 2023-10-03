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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">My Order</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="delivery-to-address-section my-order-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="place-order-section">
                    <div class="billing-details">
                        <div class="order-owner-name-email-text">
                            <h5>Saswata Roy Chowdhury</h5>
                            <p>saswata.uv@gmail.com</p>
                        </div>
                        <div class="billing-price-section order-list-section">
                            <ul>
                                <li><a class="track-order-btn" href="#">Orders <span class="track-order-text">(Track your order here)</span></a></li>
                            </ul>
                        </div>
                        <div class="billing-price-section">
                            <ul>
                                <li><a class="track-order-btn" href="#">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="confirm-order-payment-option-header-text">
                    <h5>MY ORDERS</h5>
                </div>
                @foreach ($orders as $order)
                <div class="cart-image-text-total-section order-product-image-text-section">
                    <div class="order-id-order-placed-track-order-section">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="order-id-order-placed-text">
                                    <div class="order-id-text-section">
                                        <a href="javascript:void(0);">Order   <span class="order-id-number">#{{$order->order_number}}</span></a>
                                    </div>
                                    <div class="order-placed-text">
                                        <p>Order Placed {{date('D jS M y',strtotime($order->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="track-location-order-btn">
                                    <a href="#"><i class="fa-solid fa-location-crosshairs"></i> &nbsp;Track Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-product-image-text-row-section">
                        <div class="row g-3">
                            @foreach ($order->order_items as $order_item)
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="cart-product-image">
                                            <a href="#"><img src="assets/images/product-details-image1.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="#">{{$order_item->product_name}}</a></h5>
                                            <p>Oversized T-Shirts</p>
                                        </div>
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ {{$order_item->total_price}}</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">S</span></h5>
                                                </div>
                                                <div class="filter-section-header-text order-quantity-text">
                                                    <h5>Quantity : <span>{{$order_item->quantity}}</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="cancel-my-order-total-price-section">
                        <div class="my-order-cancel-order-btn">
                            <a href="#"><i class="fa-light fa-xmark"></i> &nbsp;Cancel Order</a>
                        </div>
                        <div class="my-order-total-price-text">
                            <h5>Rs. {{$order->final_price}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <div class="cart-image-text-total-section order-product-image-text-section">
                    <div class="order-id-order-placed-track-order-section">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="order-id-order-placed-text">
                                    <div class="order-id-text-section">
                                        <a href="#">Order   <span class="order-id-number">#R1235479852</span></a>
                                    </div>
                                    <div class="order-placed-text">
                                        <p>Order Placed Thu 17th Nov 16</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="track-location-order-btn">
                                    <a href="#"><i class="fa-solid fa-location-crosshairs"></i> &nbsp;Track Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-product-image-text-row-section">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="cart-product-image">
                                            <a href="#"><img src="assets/images/product-details-image1.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="#">Spider-Man: Pavitr Prabhakar</a></h5>
                                            <p>Oversized T-Shirts</p>
                                        </div>
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ 805</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">S</span></h5>
                                                </div>
                                                <div class="filter-section-header-text order-quantity-text">
                                                    <h5>Quantity : <span>1</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="cart-product-image">
                                            <a href="#"><img src="assets/images/product-details-image1.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="#">Spider-Man: Pavitr Prabhakar</a></h5>
                                            <p>Oversized T-Shirts</p>
                                        </div>
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ 805</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">S</span></h5>
                                                </div>
                                                <div class="filter-section-header-text order-quantity-text">
                                                    <h5>Quantity : <span>1</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cancel-my-order-total-price-section">
                        <div class="my-order-cancel-order-btn">
                            <a href="#"><i class="fa-light fa-xmark"></i> &nbsp;Cancel Order</a>
                        </div>
                        <div class="my-order-total-price-text">
                            <h5>Rs. 1,610</h5>
                        </div>
                    </div>
                </div>
                <div class="cart-image-text-total-section order-product-image-text-section">
                    <div class="order-id-order-placed-track-order-section">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="order-id-order-placed-text">
                                    <div class="order-id-text-section">
                                        <a href="#">Order <span class="order-id-number">#R1235479852</span></a>
                                    </div>
                                    <div class="order-placed-text">
                                        <p>Order Placed Thu 17th Nov 16</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="track-location-order-btn">
                                    <a href="#"><i class="fa-solid fa-location-crosshairs"></i> &nbsp;Track Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-product-image-text-row-section">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="cart-product-image">
                                            <a href="#"><img src="assets/images/product-details-image1.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="#">Spider-Man: Pavitr Prabhakar</a></h5>
                                            <p>Oversized T-Shirts</p>
                                        </div>
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ 805</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">S</span></h5>
                                                </div>
                                                <div class="filter-section-header-text order-quantity-text">
                                                    <h5>Quantity : <span>1</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-4">
                                        <div class="cart-product-image">
                                            <a href="#"><img src="assets/images/product-details-image1.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="#">Spider-Man: Pavitr Prabhakar</a></h5>
                                            <p>Oversized T-Shirts</p>
                                        </div>
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ 805</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">S</span></h5>
                                                </div>
                                                <div class="filter-section-header-text order-quantity-text">
                                                    <h5>Quantity : <span>1</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cancel-my-order-total-price-section">
                        <div class="my-order-cancel-order-btn">
                            <a href="#"><i class="fa-light fa-xmark"></i> &nbsp;Cancel Order</a>
                        </div>
                        <div class="my-order-total-price-text">
                            <h5>Rs. 1,610</h5>
                        </div>
                    </div>
                </div> -->
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