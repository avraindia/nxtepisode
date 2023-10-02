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
@endphp

    @foreach ($cartItems as $item)
    @php

    $price = $item->price;
    $name = $item->name;
    $quantity = $item->quantity;
    $total_price = $item->price;
    $total_price = number_format($total_price,"2");
    $attributes = $item->attributes;
    $product_image = $attributes->product_image;
    $size_id = $attributes->size_id;
    $product_id = $attributes->product_id;
    $total_quantity = $total_quantity+$quantity;
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
                    <span class="offer-price">₹ {{$total_price}}</span>
                </div>
                <div class="size-quantity-section">
                    <div class="row g-2">
                        <div class="col-md-3 col-6">
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
                        <div class="col-md-3 col-6">
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
            <a class="remove-btn remove_from_cart" href="javascript:void(0);" pr_id="{{$item->id}}>Remove</a>
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
<div class="col-lg-4 col-md-12">
    <div class="place-order-section">
        <!-- <div class="product-section-check-box save-an-additional-section">
            <input type="checkbox" id="combos">
            <label for="combos">Save an additional ₹ 50.48 on this order.</label>
        </div> -->
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
                                    <a href="#">APPLY</a>
                                </div>
                                <input type="text" placeholder="Enter Code Here">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>	
        </div>
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
            <a href="#">Place Order</a>
        </div>
    </div>
</div>
