<div class="row">
    <div class="confirm-order-payment-option-header-text">
        <h5>My Wishlist ({{$product_count}} items)</h5>
    </div>
    @foreach($all_products as $product)
    <div class="col-xl-3 col-lg-4 col-lg-6 col-6">
        <div class="product-details-section">
            <div class="product-wishlist-remove-wishlist-btn">
                <a href="javascript:void(0);" class="remove_wishlist_item" product_id="{{$product->id}}"><i class="fa-regular fa-xmark"></i></a>
            </div>
            <a href="{{route('front_product_details',base64_encode($product->id))}}">
                @foreach($product->gallery_images as $image)
                    @php
                    $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                    @endphp
                    @break
                @endforeach
                <div class="product-filter-product-image">
                    <img src="{{$product_thumbnail_image_link}}" alt="">
                </div>
                <div class="product-filter-product-image-name-text">
                    <h5>{{$product->fitting_title}}</h5>
                </div>
                <div class="product-filter-product-image-details-text">
                    <h6>{{$product->type_name}} for {{$product->gender}}</h6>
                </div>
                <div class="product-image-price-section">
                    <?php
                        $product_gst = $product->gst;
                        if($product_gst == 0){
                            $product_gst = $global_gst;
                        }
                        $product_mrp = $product->product_mrp;
                        $gst_amount = ($product_mrp*$product_gst)/100;
                        $gst_amount = round($gst_amount);
                        $amount_after_gst = $product_mrp+$gst_amount;
                        $amount_after_gst = $amount_after_gst.'.00';
                    ?>
                    <span class="offer-price">₹ {{$amount_after_gst}}</span>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    <div class="col-lg-12">
        <nav>
        {!! $all_products->links() !!}
        </nav>
    </div>
</div>