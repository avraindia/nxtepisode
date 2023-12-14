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
            @include('pages.frontend.user-sidebar-child') 
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
                                        <a href="{{route('order_details',base64_encode($order->id))}}">Order   <span class="order-id-number">#{{$order->order_number}}</span></a>
                                    </div>
                                    <div class="order-placed-text">
                                        <p>Order Placed {{date('D jS M y',strtotime($order->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="track-location-order-btn">
                                    <a href="javascript:void(0);"><i class="fa-solid fa-location-crosshairs"></i> &nbsp;Track Order</a>
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
                                            <a href="{{route('front_product_details',base64_encode($order_item->product_id))}}">
                                                <img src="{{$order_item->product_image}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="{{route('front_product_details',base64_encode($order_item->product_id))}}">{{$order_item->product_name}}</a></h5>
                                            <p>{{$order_item->fitting_type}}</p>
                                        </div>
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ {{$order_item->total_price}}</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">{{$order_item->size_name}}</span></h5>
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
                    @php
                        $order_status = App\Http\Controllers\AdminController::last_status_of_order($order->id);
                        $status_name = $order_status->status_name;
                        $check_status_arr = ['Cancelled','Delivered']
                    @endphp
                    
                    <div class="cancel-my-order-total-price-section">
                        <div class="my-order-cancel-order-btn">
                            @if (!in_array($status_name, $check_status_arr))
                                <a href="javascript:void(0);" class="cancel_order" order_id="{{$order->id}}"><i class="fa-light fa-xmark"></i> &nbsp;Cancel Order</a>
                            @endif

                            @if ($status_name == 'Delivered')
                                <a href="javascript:void(0);">Order Delivered</a>
                            @endif

                            @if ($status_name == 'Cancelled')
                                <a href="javascript:void(0);">Order Cancelled</a>
                            @endif
                        </div>
                        <div class="my-order-total-price-text">
                            <h5>Rs. {{$order->final_price}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->
@stop

@push('scripts')
<script>
$(document).on('click', '.cancel_order', function(e) {
    var order_id = $(this).attr('order_id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#23af41',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Proceed!'
    }).then((result) => {
        if (result.isConfirmed) {
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('cancel_order') }}",
                method: 'POST',
                data: {_token: _token, order_id:order_id},
                success: function (data) { 
                    if(data.resp == true){
                        location.reload();
                    }
                }
            });
        } 
    });
});
</script>
@endpush