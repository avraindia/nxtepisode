<div class="product-filter-product-right-side-header-text">
    <h5>Showing results of - <span class="product-items-color-text">{{$product_count}}
            items</span></h5>
</div>
<div class="product-filter-product-image-price-section">
    <div class="row">
        @foreach($all_products as $product)
        <div class="col-xl-3 col-lg-4 col-lg-6 col-6">
            <div class="product-details-section">
                <?php
                if($is_exchange == 'yes'){
                    $concat_str = $product->id.'_'.$exchange_id;
                    $redirect_url = route('exchange_product_details',base64_encode($concat_str));
                }else{
                    $redirect_url = route('front_product_details',base64_encode($product->id));
                }
                ?>
                <a href="{{$redirect_url}}">
                    <div class="product-filter-product-image">
                        @foreach($product->gallery_images as $image)
                            @php
                            $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                            @endphp
                            @break
                        @endforeach
                        <img src="{{$product_thumbnail_image_link}}" alt="">
                    </div>
                    <div class="product-filter-product-image-name-text">
                        <h5>{{$product->fitting_title}}</h5>
                    </div>
                    <div class="product-filter-product-image-details-text">
                        <h6>{{$product->type_name}} for {{$product->gender}}</h6>
                    </div>
                    <div class="product-image-price-section">
                        <span class="offer-price">₹ {{$product->product_mrp}}</span>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-lg-12">
        <nav>
        {!! $all_products->links() !!}
        </nav>
    </div>
</div>