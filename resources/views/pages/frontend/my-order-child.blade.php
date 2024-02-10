<div class="my-order-list">
    @foreach ($orders as $order)
    <div class="cart-image-text-total-section order-product-image-text-section">
        <div class="order-id-order-placed-track-order-section">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="order-id-order-placed-text">
                        <div class="order-id-text-section">
                            <a href="{{route('order_details',base64_encode($order->id))}}">Order   <span class="order-id-number">#{{$order->order_number}}</span></a>
                        </div>
                        <div class="order-placed-text">
                            <p>Order Placed {{date('D jS M y',strtotime($order->created_at))}}</p>
                        </div>
                    </div>
                </div>
                @php
                    $order_status = App\Http\Controllers\AdminController::last_status_of_order($order->id);
                    $status_name = $order_status->status_name;
                    $check_status_arr = ['Cancelled','Delivered']
                @endphp
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="my-order-product-right-side-three-btn">
                        <div class="exchange-order-badge product-right-side-three-btn">
                            @if ($order->is_exchange == 'yes')
                            <h5>Exchange Order</h5>
                            @endif
                        </div>
                        <div class="exchange-order-badge order-placed-section product-right-side-three-btn">
                            <h5>{{$status_name}}</h5>
                        </div>
                        <div class="track-location-order-btn product-right-side-three-btn">
                            <a href="javascript:void(0);"><i class="fa-solid fa-location-crosshairs"></i> &nbsp;Track Order</a>
                        </div>
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
    <div class="col-lg-12">
        <nav>
        {!! $orders->links() !!}
        </nav>
    </div>
</div>