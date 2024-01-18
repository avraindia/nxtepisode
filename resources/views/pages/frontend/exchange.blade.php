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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">Product Exchange</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="delivery-to-address-section my-order-section product-exchange-total-section">
    <div class="container">
        <div class="row">
            @include('pages.frontend.user-sidebar-child') 
            <div class="col-lg-9 col-md-12">
                <div class="confirm-order-payment-option-header-text">
                    <h5>MY ORDERS / MY ORDERS Details / <b>ORDER EXCHANGE</b></h5>
                </div>
                <div class="cart-image-text-total-section order-product-image-text-section">
                    <div class="order-id-order-placed-track-order-section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="order-id-order-placed-text">
                                    <div class="order-id-text-section">
                                        <h6>Order   <span class="order-id-number">#{{$order_details->order_number}}</span></h6>
                                    </div>
                                    <div class="order-placed-text">
                                        <p>Order Placed {{date('D jS M y',strtotime($order_details->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart-product-image-text-row-section product-exchange-section">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3 col-4">
                                        <div class="cart-product-image">
                                            <a href="{{route('front_product_details',base64_encode($order_item_details->product_id))}}"><img src="{{$order_item_details->product_image}}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-sm-9 col-8">
                                        <div class="cart-product-details-text">
                                            <h5><a href="{{route('front_product_details',base64_encode($order_item_details->product_id))}}">{{$order_item_details->product_name}}</a></h5>
                                            <p>{{$order_item_details->fitting_type}}</p>
                                        </div>
                                        
                                        <div class="product-image-price-section">
                                            <span class="offer-price">₹ {{$order_item_details->sell_price}}</span>
                                        </div>
                                        <div class="size-quantity-section">
                                            <div class="size-section order-size-quantity-section">
                                                <div class="filter-section-header-text">
                                                    <h5>Size : <span class="">{{$order_item_details->size_name}}</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cancel-my-order-total-price-section select-replacement-section">
                        <div class="select-replacement-title-text">
                            <div class="material-care-section">
                                <h6>Select Replacement Quantity :</h6>
                            </div>
                        </div>
                        <div class="product-size-select">
                            <select name="quantity" id="quantity">
                                @for ($i = 1; $i <= $order_item_details->quantity; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="cancel-my-order-total-price-section select-replacement-section exchange-price-total-section">
                        <div class="select-replacement-title-text">
                            <div class="material-care-section">
                                <h6>Total Exchange Price :</h6>
                            </div>
                        </div>
                        <div class="my-order-total-price-text exchange-price-text">
                            <h5 class="exchange_price_text">₹ {{$order_item_details->sell_price}}</h5>
                        </div>
                    </div>
                    <div class="reason-for-exchange-section">
                        <div class="material-care-section">
                            <h6>Reason for Exchange</h6>
                            <p>Please tell us the reason for exchange as it will help us serve you better
                            in the future</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-size-select">
                                    <select name="quantity" id="exchange" class="exchange_reason">
                                        <option selected disabled>Select exchange reason*</option>
                                        @foreach ($exchange_reasons as $exchange_reason)
                                        <option value="{{$exchange_reason->id}}">{{$exchange_reason->reason}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-size-select">
                                    <select name="quantity" id="exchange" class="exchange_issue">
                                        <option selected disabled>Select issue*</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="additional-remark-section">
                                    <div class="material-care-section">
                                        <p>Additional Remarks</p>
                                    </div>
                                    <div class="additional-remark-textarea">
                                        <textarea cols="30" rows="6" name="additional_remarks" class="additional_remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mode-of-exchange-section">
                        <!-- <div class="material-care-section">
                            <h6>Mode of Exchange</h6>
                        </div> -->
                        <div class="reverse-pickup-drop-section">
                            <div class="reverse-pickup-drop-title-text">
                                <h6>Terms and Conditions</h6>
                            </div>
                            <div class="reverse-pickup-drop-title-list">
                                <ul>
                                    <li>Ensure that the product is in good condition and the tags are intact</li>
                                    <li>Pack the product securely to prevent any loss or damage during transit</li>
                                    <li>The product will be picked up by our courier partners within 3 working days</li>
                                    <li>Once the product is picked up, a fresh product will be dispatched from our warehouse within 3-4 working days</li>
                                </ul>
                            </div>
                            <div class="place-order-section">
                                <div class="product-section-check-box save-an-additional-section exchange-check">
                                    <input type="checkbox" id="combos" class="agree_check">
                                    <label for="combos">I agree that the product is unused with original tags intact</label>
                                </div>
                            </div>
                            <div class="exchange-section-back-exchange-btn">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="add-to-wishlist-btn">
                                            <a href="javascript:void(0);" onclick="history.back();">Back</a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="add-to-wishlist-btn">
                                            <a href="javascript:void(0);" name="exchange_btn" class="exchange_btn">Exchange</a>
                                        </div>
                                    </div>
                                </div>
                                <form id="submitForm" action="{{ route('submit_exchange') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" class="order_id" value="{{$order_details->id}}">
                                    <input type="hidden" name="order_item_id" class="order_item_id" value="{{$order_item_details->id}}">
                                    <input type="hidden" name="product_id" class="product_id" value="{{$order_item_details->product_id}}">
                                    <input type="hidden" name="product_single_price" class="product_single_price" value="{{$order_item_details->sell_price}}">
                                    <input type="hidden" name="product_quantity" class="product_quantity" value="1">
                                    <input type="hidden" name="exchange_total_price" class="exchange_total_price" value="{{$order_item_details->sell_price}}">
                                </form>
                            </div>
                        </div>
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
$(document).on('change', '#quantity', function() {
    var quantity = $(this).val();
    var product_single_price = $('.product_single_price').val();
    var exchange_total_price = product_single_price*quantity;
    exchange_total_price = parseFloat(exchange_total_price).toFixed(2);

    $('.product_quantity').val(quantity);
    $('.exchange_total_price').val(exchange_total_price);
    $('.exchange_price_text').text('₹ '+exchange_total_price);
});

$(document).on('change', '.exchange_reason', function() {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var id_reason = $(this).val();
    $.ajax({
        url: "{{ route('fetch_exchange_issue') }}",
        method: 'POST',
        data: {_token: _token, id_reason:id_reason},
        success: function (data) { 
            var exchange_issues = data.exchange_issues;
            var html = '<option selected disabled>Select issue*</option>';
            for(var i=0; i<exchange_issues.length; i++){
                var single_item = exchange_issues[i];
                html += '<option value="'+single_item.id+'">'+single_item.issue+'</option>';
            }
            $('.exchange_issue').html(html);
        }
    });
});

$(document).on('click', '.exchange_btn', function() {
    var valid = true;
    var order_id = $('.order_id').val();
    var order_item_id = $('.order_item_id').val();
    var product_id = $('.product_id').val();
    var product_quantity = $('.product_quantity').val();
    var exchange_total_price = $('.exchange_total_price').val();
    var reason_id = $('.exchange_reason').val();
    var issue_id = $('.exchange_issue').val();
    var additional_remarks = $('.additional_remarks').val();
    var _token = $('meta[name="csrf-token"]').attr('content');

    if(reason_id == null){
        $('.exchange_reason').css('border-color', 'red');
        valid = false;
    }else{
        $('.exchange_reason').css('border-color', '');
    }

    if(issue_id == null){
        $('.exchange_issue').css('border-color', 'red');
        valid = false;
    }else{
        $('.exchange_issue').css('border-color', '');
    }

    if ($('input.agree_check').is(':checked')) {
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Please check the agree box.',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'OK',
        });
        valid = false;
    }

    if(valid == false){
        return false;
    }

    $.ajax({
        url: "{{ route('submit_exchange') }}",
        method: 'POST',
        data: {_token: _token, order_id:order_id, order_item_id:order_item_id, product_id:product_id, product_quantity:product_quantity, exchange_total_price:exchange_total_price, reason_id:reason_id, issue_id:issue_id, additional_remarks:additional_remarks},
        success: function (data) { 
            var exchange_id = data.exchange_id;
            var url = "{{ route('products')}}";
            var redirect_url = url+'?ex='+exchange_id
            window.location.href = redirect_url;
        }
    });
});
</script>
@endpush