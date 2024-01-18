<div class="col-lg-8 col-md-12">
    <div class="cart-image-text-total-section">
@if ($message = Session::get('success'))
    <div class="alert alert-success">
    {{ $message }}
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger">
    {{ $message }}
    </div>
@endif
@php
    $total_quantity = 0;
    $all_product_total_price = 0;
    $discount = '0.00';
    $total_mrp_price = 0;
@endphp

    @foreach ($cartItems as $item)
    @php

    $price = $item->price;
    $name = $item->name;
    $quantity = $item->quantity;
    $total_price = $item->price;
    $all_product_total_price = $all_product_total_price+$total_price;
    $show_total_price = number_format($total_price,"2");
    $attributes = $item->attributes;
    $product_image = $attributes->product_image;
    $size_id = $attributes->size_id;
    $product_id = $attributes->product_id;
    $total_quantity = $total_quantity+$quantity;
    $gst_amount = $attributes->gst_amount;
    $net_price = $total_price-$gst_amount;
    $total_mrp_price = $total_mrp_price + $net_price;

    @endphp
    <div class="cart-product-image-text-row-section">
        <div class="row">
            <div class="col-md-3 col-4">
                <div class="cart-product-image">
                    <a href="#"><img src="{{$product_image}}" alt=""></a>
                </div>
            </div>
            <div class="col-md-9 col-8">
                <div class="cart-product-details-text">
                    <h5><a href="#">{{$name}}</a></h5>
                    <!-- <p>Oversized T-Shirts</p> -->
                </div>
                <div class="product-image-price-section">
                    <span class="offer-price">₹ {{$show_total_price}}</span>
                </div>
                <div class="size-quantity-section">
                    <div class="row g-2">
                        <div class="col-md-12 col-12">
                            <div class="size-section">
                                <div class="filter-section-header-text">
                                    @foreach ($sizes as $size)
                                        @if ($size->id == $size_id)
                                        <h5>Size : {{$size->option_value}}</h5>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="product-size-select">
                                    <input type="hidden" class="variation_id" name="variation_id" value="{{ $item->id }}" >
                                    <input type="hidden" class="product_id" name="product_id" value="{{ $product_id }}" >
                                    <input type="hidden" class="size_id" name="size_id" value="{{ $size_id }}" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="size-section">
                                <div class="filter-section-header-text">
                                    <h5>Quantity</h5>
                                </div>
                                <div class="product-size-select">
                                    <select name="quantity" class="cart_item_quantity" id="size">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" @if($i == $quantity) selected @endif>{{ $i }}</option>
                                    @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="remove-wishlist-btn desktop-remove-wishlist-btn">
                    <a class="remove-btn remove_from_cart" href="javascript:void(0);" pr_id="{{$item->id}}">Remove</a>
                    <a class="move-to-wishlist-btn" href="#">MOVE TO WISHLIST</a>
                </div>
            </div>
        </div>
        <div class="remove-wishlist-btn for-responsive-remove-wishlist-btn">
            <a class="remove-btn remove_from_cart" href="javascript:void(0);" pr_id="{{$item->id}}">Remove</a>
            <a class="move-to-wishlist-btn" href="#">MOVE TO WISHLIST</a>
        </div>
    </div>
    @endforeach
    @if ($total_quantity == 0)
    <div class="empty-content">
        <img src="{{ asset('frontend/images/cart-empty.png') }}" class="" alt="">
        <h4>Your cart is empty</h4>
        <p>Looks like you have not added anything to your cart.</p>
    </div>
    @endif
    </div>   
</div>
@php
$all_product_total_price = number_format($all_product_total_price, 2, '.', '');
$full_amount = $all_product_total_price;
$full_amount = number_format($full_amount, 2, '.', '');
@endphp

<div class="col-lg-4 col-md-12">
    <div class="place-order-section">
        <!-- <div class="product-section-check-box save-an-additional-section">
            <input type="checkbox" id="combos">
            <label for="combos">Save an additional ₹ 50.48 on this order.</label>
        </div> -->
        @if ($total_quantity != 0)
        <div class="product-details-faq-section">
            <div class="faq-blocks">
                <ul class="faq-tab">
                    <li>
                        <a href="javascript:void(0);">Apply Coupon<i class="fa fa-angle-down" aria-hidden="true"></i>
                            <div class="apply-coupon-icon">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                        </a>
                        
                        <div class="faq-content">
                            <div class="apply-coupon-input">
                                <div class="apply-coupon-apply-btn">
                                    <a href="javascript:void(0);" class="apply_promo_btn">APPLY</a>
                                </div>
                                <input type="text" name="promo_code" class="promo_code" placeholder="Enter Code Here">
                            </div>
                            <div class="alert promocode_resp" style="display:none;"></div>
                        </div>
                        
                    </li>
                </ul>
            </div>	
        </div>
        @endif
        <div class="billing-details">
            <div class="billing-details-header-text">
                <h5>BILLING DETAILS</h5>
            </div>
            <div class="billing-price-section">
                <ul>
                    <li>Cart Total <span class="price-text">₹ {{$all_product_total_price}}</span></li>
                    @if ($total_quantity != 0)
                    <li>Discount <span class="discount-text">- ₹ 0.00</span></li>
                    <li>Total Amount <span class="price-text total-amount">₹ {{$full_amount}}</span></li>
                    @else
                    <li>Total Amount <span class="price-text total-amount">₹ 0.00</span></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="place-order-btn">
        @if ($total_quantity != 0)
        <form id="submitForm" action="{{ route('checkout') }}" method="post" enctype="multipart/form-data">
            @csrf
            <a href="javascript:void(0);" class="place_order">Place Order</a>
            <input type="hidden" name="shipping_fee_inside_west_bengal" class="shipping_fee_inside_west_bengal" value="{{$shipping_fee_inside_west_bengal}}">
            <input type="hidden" name="shipping_fee_outside_west_bengal" class="shipping_fee_outside_west_bengal" value="{{$shipping_fee_outside_west_bengal}}">
            <input type="hidden" name="total_price" class="total_price" value="{{$all_product_total_price}}">
            <input type="hidden" name="full_amount" class="full_amount" value="{{$full_amount}}">
            <input type="hidden" name="discount" class="discount" value="{{$discount}}">
            <input type="hidden" name="is_promocode_applied" class="is_promocode_applied" value="0">
            <input type="hidden" name="promocode_id" class="promocode_id" value="0">
            <input type="hidden" name="total_mrp_price" class="total_mrp_price" value="{{$total_mrp_price}}">
            <input type="hidden" name="final_amount" class="final_amount" value="{{$full_amount}}">
        </form>
        @endif
        </div>
    </div>
</div>
