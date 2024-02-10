@extends('layouts.front')
@section('content')
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 20px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #222;
        background-color: #ccc;
    }
    .product_type{
        width: 80px !important;
    }
    .no_size{
        text-decoration: line-through;
        border: 2px solid #b1bbcd !important;
    }
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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">{{$product_details->fitting_title}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="product-list-section">
    <div class="container">
        <div class="row g-md-5">
            <div class="col-lg-7 col-md-6">
                <div class="product-details-image-section">
                    <div class="owl-carousel product-details-image-slider owl-theme">
                        @foreach($product_details->gallery_images as $key=>$product_image)
                        <div class="item">
                            <div class="product-details-image">
                                <img src="{{$product_image->product_details_image_link}}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <?php
            $product_gst = $product_details->gst;
            if($product_gst == 0){
                $product_gst = $global_gst;
            }
            $product_mrp = $product_details->product_mrp;
            $gst_amount = ($product_mrp*$product_gst)/100;
            $gst_amount = round($gst_amount);
            $amount_after_gst = $product_mrp+$gst_amount;
            $amount_after_gst = $amount_after_gst.'.00';
            ?>
            <div class="col-lg-5 col-md-6">
                <div class="product-details-text">
                    <div class="product-details-header-text">
                        <h5>{{$product_details->fitting_title}}</h5>
                    </div>
                    <div class="prod-cat-text">
                        <a href="javascript:void(0);">{{$product_details->type_name}} for {{$product_details->gender}}</a>
                    </div>
                    <div class="product-image-price-section">
                        <span class="offer-price">₹ {{$amount_after_gst}}</span>
                        <input type="hidden" name="default_mrp" class="default_mrp" value="{{$product_details->product_mrp}}">
                        <input type="hidden" name="default_gst" class="default_gst" value="{{$gst_amount}}">
                        <input type="hidden" name="default_amount_after_gst" class="default_amount_after_gst" value="{{$amount_after_gst}}">
                        <input type="hidden" name="current_mrp" class="current_mrp" value="{{$product_details->product_mrp}}">
                        <input type="hidden" name="cart_price" class="cart_price" value="{{$product_details->product_mrp}}">
                        <input type="hidden" name="gst_amount" class="gst_amount" value="{{$gst_amount}}">
                        <input type="hidden" name="amount_after_gst" class="amount_after_gst" value="{{$amount_after_gst}}">
                        
                        <!-- <span class="product-price">₹ 1048</span>
                        <span class="percentage-off">23% OFF</span> -->
                    </div>

                    <div class="select-the-size-btn">
                        <span>Please select a size. </span>
                        <!-- <a href="#">SIZE CHART</a> -->
                    </div>
                    
                    <div class="size-select-btn">
                        @foreach($sizes as $size)
                        <label>
                            <input type="radio" name="size_id" class="size_id" value="{{$size->id}}" @if(!in_array($size->id, $size_ids)) disabled  @endif>
                            <span @if(!in_array($size->id, $size_ids)) class="no_size"  @endif>{{$size->option_value}}</span>
                        </label>
                        @endforeach
                    </div>
                    <div class="alert size_resp" style="display:none;"></div>
                    <!-- <div class="select-the-size-btn size-notify-btn">
                        <span>Size not available?</span>
                        <a href="#">Notify Me</a>
                    </div> -->

                    <div class="product-quantity-section">
                        <h6>Quantity :</h6>
                        <div class="qty-input">
                            <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                            <input class="product-qty" type="number" name="product-qty" min="1" max="10" value="1" readonly>
                            <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                        </div>
                    </div>
                    <div class="add-to-cart-add-to-wishlist-btn">
                        <div class="row g-md-3">
                            <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                <div class="add-to-cart-btn">
                                @if (auth()->check())
                                    <?php
                                    $cartItems = \Cart::getContent();
                                    $state = isset($cartItems[$product_details->id]) ? $cartItems[$product_details->id] : false;
                                    if (!$state){
                                    ?>
                                        <a href="javascript:void(0);" class="add_to_cart" status="logged_in">Add to cart</a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="{{route('cart')}}">Go to cart</a>
                                    <?php } ?>
                                @else
                                    <a href="javascript:void(0);" class="add_to_cart" status="not_logged_in">Add to cart</a>
                                @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                <div class="add-to-wishlist-btn">
                                    <a href="javascript:void(0);" class="add_to_wishlist"><i class="fa-sharp fa-light fa-heart"></i> &nbsp;Add to Wishlist</a>
                                </div>
                            </div>
                            
                            <input type="hidden" name="product_name" class="product_name" value="{{$product_details->fitting_title}}">
                            <input type="hidden" name="product_id" class="product_id" value="{{$product_details->product_id}}">
                            <input type="hidden" name="cart_available" class="cart_available" value="no">
                            <input type="hidden" name="variation_id" class="variation_id" value="{{$product_details->id}}">
                            <input type="hidden" name="product_stock" class="product_stock" value="0">
                            <input type="hidden" name="product_sku" class="product_sku" value="{{$product_details->sku}}">
                            <input type="hidden" name="product_gst" class="product_gst" value="{{$product_gst}}">
                            @foreach($product_details->gallery_images as $image)
                                @php
                                $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                                @endphp
                                @break
                            @endforeach
                            <input type="hidden" name="product_image" class="product_image" value="{{$product_thumbnail_image_link}}">
                        </div>
                    </div>
                    @if (\Session::has('successmsg'))
                        <br/>
                        <div class="alert alert-success">
                            {!! \Session::get('successmsg') !!}
                        </div>
                    @endif
                    <div class="share-social-media-section">
                        <h6>Share :</h6>
                        <div class="social-media-link">
                            {!! $shareComponent !!}
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="product-rating-section">
                                <h6>product rating</h6>
                                <span>{{$avearge_rating}}</span>
                                    <?php
                                    if($avearge_rating > 0){
                                        $intpart = floor( $avearge_rating );
                                        $fraction = $avearge_rating - $intpart;

                                        $star_count = $intpart;
                                        if($fraction > 0){
                                            $star_count = $intpart+1;
                                        }
                                        
                                        for($i=1; $i<=$star_count; $i++){
                                            if($i == $star_count){
                                                if($fraction > 0){
                                                    $star_css = " fa-star-sharp-half-stroke";
                                                }else{
                                                    $star_css = " fa-star-sharp";
                                                }
                                            }else{
                                                $star_css = " fa-star-sharp";
                                            }
                                            echo '<i class="fa-solid'.$star_css.'"></i>';
                                        }

                                        $existing_star = 5-$star_count;
                                        if($existing_star>0){
                                            for($j=1; $j<=$existing_star; $j++){
                                                echo '<i class="fa-regular fa-star-sharp"></i>';
                                            }
                                        }
                                    }else{
                                        ?>
                                        <i class="fa-regular fa-star-sharp"></i>
                                        <i class="fa-regular fa-star-sharp"></i>
                                        <i class="fa-regular fa-star-sharp"></i>
                                        <i class="fa-regular fa-star-sharp"></i>
                                        <i class="fa-regular fa-star-sharp"></i>
                                        <?php
                                    }
                                    ?>
                                    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="add-review-btn">
                            @if (auth()->check())
                                @if (count($user_review) > 0)  
                                <button class="review_modal_btn" status="logged_in"><i class="fa-regular fa-circle-plus"></i> &nbsp;Edit Review</button>
                                <input type="hidden" name="review_id" class="review_id" value="{{$user_review[0]->id}}">
                                @else
                                <button class="review_modal_btn" status="logged_in"><i class="fa-regular fa-circle-plus"></i> &nbsp;Add Review</button>
                                <input type="hidden" name="review_id" class="review_id" value="">
                                @endif
                            @else
                                <button class="review_modal_btn" status="not_logged_in"><i class="fa-regular fa-circle-plus"></i> &nbsp;Add Review</button>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="product-details-faq-section">
                        <div class="faq-blocks">
                            <ul class="faq-tab">
                                <li>
                                    <a href="javascript:void(0);">Product Details<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div class="faq-content">
                                        <div class="material-care-section">
                                        {!! $product_details->details !!}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Product Description<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div class="faq-content">
                                        <div class="material-care-section">
                                            {!! $product_details->description !!}
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Product Review<i class="fa fa-angle-down angel" aria-hidden="true"></i></a>
                                    <div class="faq-content review-list-content">
                                        <div class="product-review-image-text-section">
                                            <ul class="review_list">
                                            @foreach ($product_review as $review)
                                                <li>
                                                    <div class="product-review-image-text-total-section">
                                                        <div class="product-review-image">
                                                            <img src="{{$review->user_details->profile_image_link}}" alt="">
                                                        </div>
                                                        <div class="review-text">
                                                            <div class="review-head-name-text">
                                                                <h6>{{$review->user_details->full_name}}</h6>
                                                            </div>
                                                            <div class="review-star">
                                                                <h6><i class="fa-sharp fa-solid fa-star star-icon"></i> &nbsp;{{$review->rating}}.0</h6>
                                                            </div>
                                                            <div class="review-pera">
                                                                <p>{{$review->review}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach  
                                            </ul>
                                            @if ($review_count > 4)  
                                                <div class="review-details-show-more-btn">
                                                    <button class="show_more_review">Show More</button>
                                                    <input type="hidden" class="review_offset" value="4">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->
<!-- add address popup section start-->
<div class="modal fade" id="add-reviewModal" tabindex="-1" aria-labelledby="add-reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-reviewModalLabel">Add Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="new-address-form-section">
                    <div class="add-review-modal-popup-image">
                        <img src="{{ asset('frontend/images/write-review-popup-img.png') }}" alt="">
                    </div>
                    <div class="add-review-popup-text">
                        <h5>Lets Us Know Your Feedback, We Would Like To Hear From You</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="add-review-text">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="add-rating-section">
                                    <div class="add-rating-text">
                                        <h5>Your Rating</h5>
                                    </div>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="Excellent">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="Good">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="OK">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="Poor">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" checked />
                                        <label for="star1" title="Very Bad">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="add-rating-text">
                                    <h5>Write Feedback</h5>
                                </div>
                                <div class="new-address-form-input">
                                    <textarea cols="30" rows="6" name="product_feedback" class="product_feedback" placeholder="Write Feedback"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-success submit_review_btn">Add</button>
                <div class="alert review_resp"></div>
            </div>
        </div>
    </div>
</div>
<!-- add address popup section end-->
@stop

@push('scripts')
<script>
$(document).on('change', '.size_id', function(e) {
    $('.cart_available').val('no');
    $('.product_stock').val('0');
    $('.product-qty').val('1');

    var default_mrp = $('.default_mrp').val();
    var default_gst = $('.default_gst').val();
    var default_amount_after_gst = $('.default_amount_after_gst').val();

    $('.offer-price').html('₹ '+default_amount_after_gst);
    $('.current_mrp').val(default_mrp);
    $('.gst_amount').val(default_gst);
    $('.amount_after_gst').val(default_amount_after_gst);

    $('.size_resp').removeClass('alert-danger').html('');
    $('.size_resp').hide();

    var size_id = $('input[name="size_id"]:checked').val();
    var product_id = $('.product_id').val();

    if (typeof size_id !== "undefined") {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var product_gst = '<?=$product_gst?>';
        $.ajax({
            url: "{{ route('check_variation_exists') }}",
            method: 'POST',
            data: {_token: _token, size_id:size_id, product_id:product_id, product_gst:product_gst},
            success: function (data) { 
                if(data.status == true){
                    if(data.num != '0'){
                        $('.cart_available').val('yes');
                        $('.product_stock').val(data.current_stock);
                        $('.product_sku').val(data.sku);

                        if(data.sell_price!='0.00'){
                            $('.offer-price').html('₹ '+data.sell_price);
                            $('.current_mrp').val(data.inventory_price);
                            $('.gst_amount').val(data.gst_amount);
                            $('.amount_after_gst').val(data.sell_price);
                        }
                    }
                    calculate_cart_price();
                }
            }
        }); 
    }
});

$(document).on('click', '.add_to_cart', function(e) {
    var status = $(this).attr('status');
    if(status == 'not_logged_in'){
        Swal.fire({
            icon: 'error',
            title: 'Oops! You are not logged in.',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Login',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loginModal').modal('show');
            } 
        })
        return false;
    }
    
    var size_id = $('input[name="size_id"]:checked').val();

    if (typeof size_id === "undefined") {
        $('.size_resp').addClass('alert-danger').html('Please select a size.');
        $('.size_resp').show();
        return false;
    }else{
        $('.size_resp').removeClass('alert-danger').html('');
        $('.size_resp').hide();
    }
    
    var _token = $('meta[name="csrf-token"]').attr('content');
    var variation_id = $('.variation_id').val();
    var product_id = $('.product_id').val();
    var product_name = $('.product_name').val();
    var product_image = $('.product_image').val();
    var cart_price = $('.cart_price').val();
    var product_price = $('.current_mrp').val();
    var quantity = $('.product-qty').val();
    var product_sku = $('.product_sku').val();
    var product_gst = $('.product_gst').val();
    var gst_amount = $('.gst_amount').val();
    var sell_price = $('.amount_after_gst').val();
    
    $.ajax({
      url: "{{ route('add_to_cart') }}",
      method: 'POST',
      data: {_token: _token, variation_id:variation_id, product_id:product_id, product_name:product_name, product_image:product_image, cart_price:cart_price, product_price:product_price, quantity:quantity, size_id:size_id, product_sku:product_sku, product_gst:product_gst, gst_amount:gst_amount, sell_price:sell_price},
      success: function (data) { 
        if(data.status == true){
            location.reload();
        }
      }
  }); 
});

$(document).on('click', '.qty-count', function(e) {
    var size_id = $('input[name="size_id"]:checked').val();

    if (typeof size_id === "undefined") {
        $('.size_resp').addClass('alert-danger').html('Please select a size.');
        $('.size_resp').show();
        return false;
    }else{
        $('.size_resp').removeClass('alert-danger').html('');
        $('.size_resp').hide();
    }

    var action = $(this).attr('data-action');
    var product_quantity = $('.product-qty').val();
    var product_stock = $('.product_stock').val();

    if(action == 'add'){
        $('.qty-count--minus').attr("disabled", false);
        var new_quantity = parseInt(product_quantity)+1;
        if(new_quantity > product_stock){
            Swal.fire({
                icon: 'error',
                title: 'Oops! You have exceeding product stock.',
                showDenyButton: false,
                showCancelButton: false,
                confirmButtonText: 'OK',
            });
            return false;
        }
    }

    if(action == 'minus'){
        var new_quantity = parseInt(product_quantity)-1;
        if(new_quantity == '0'){
            $('.qty-count--minus').attr("disabled", true);
            return false;
        }
    }

    $('.product-qty').val(new_quantity);
    calculate_cart_price();
});

$(document).on('click', '.review_modal_btn', function(e) {
    var status = $(this).attr('status');
    if(status == 'not_logged_in'){
        Swal.fire({
            icon: 'error',
            title: 'Oops! You are not logged in.',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Login',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loginModal').modal('show');
            } 
        })
        return false;
    }else{
        var review_id = $('.review_id').val();
        if(review_id != ""){
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('fetch_product_review') }}",
                method: 'POST',
                data: {_token: _token, review_id:review_id},
                success: function (data) { 
                    $('.product_feedback').val(data.review_details.review);
                    $("input[name=rate][value=" + data.review_details.rating + "]").attr('checked', 'checked');
                    $('#add-reviewModalLabel').html('Edit Review');
                    $('.submit_review_btn').html('Edit');
                    $('#add-reviewModal').modal('show');
                }
            });
        }else{
            var _token = $('meta[name="csrf-token"]').attr('content');
            var product_id = $('.variation_id').val();
            $.ajax({
                url: "{{ route('fetch_if_product_purchased') }}",
                method: 'POST',
                data: {_token: _token, product_id:product_id},
                success: function (data) { 
                    if(data.review_proceed == 'yes'){
                        $('#add-reviewModalLabel').html('Add Review');
                        $('.submit_review_btn').html('Add');
                        $('#add-reviewModal').modal('show');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'You have to purchase product before submit review.',
                            showDenyButton: false,
                            showCancelButton: false,
                        });
                    }
                }
            });
        }
    }
});

$(document).on('click', '.submit_review_btn', function(e) {
    var rate = $('input[name="rate"]:checked').val();
    var product_feedback = $('.product_feedback').val();
    var product_id = $('.variation_id').val();
    var review_id = $('.review_id').val();
    if(product_feedback != ""){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('submit_product_review') }}",
            method: 'POST',
            data: {_token: _token, product_id:product_id, rate:rate, product_feedback:product_feedback, review_id:review_id},
            success: function (data) { 
                $('.review_resp').addClass('alert-success').html(data.msg);
                setTimeout(function () {
                    location.reload();
                }, 1000);	
            }
        });
    }
});

$(document).on('click', '.show_more_review', function(e) {
    var review_offset = $('.review_offset').val();
    var product_id = $('.variation_id').val();

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('fetch_show_more_product_review') }}",
        method: 'POST',
        data: {_token: _token, product_id:product_id, review_offset:review_offset},
        success: function (data) { 
            var review_list = data.review_list;
            var next_offset = data.next_offset;
            $('.review_offset').val(next_offset);
            for(var i=0; i<review_list.length; i++){
                var single_review = review_list[i];

                var html =
                '<li>'+
                    '<div class="product-review-image-text-total-section">'+
                        '<div class="product-review-image">'+
                            '<img src="'+single_review.user_details.profile_image_link+'" alt="">'+
                        '</div>'+
                        '<div class="review-text">'+
                            '<div class="review-head-name-text">'+
                                '<h6>'+single_review.user_details.full_name+'</h6>'+
                            '</div>'+
                            '<div class="review-star">'+
                                '<h6><i class="fa-sharp fa-solid fa-star star-icon"></i> &nbsp;'+single_review.rating+'.0</h6>'+
                            '</div>'+
                            '<div class="review-pera">'+
                                '<p>'+single_review.review+'</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</li>';
                $('.review_list').append(html);
            }
        }
    });
});

function calculate_cart_price(){
    var product_quantity = $('.product-qty').val();
    var amount_after_gst = $('.amount_after_gst').val();

    var total_price = product_quantity*amount_after_gst;
    total_price = parseFloat(total_price).toFixed(2);
    //$('.offer-price').html('₹ '+total_price);
    $('.cart_price').val(total_price);
}


</script>
@endpush