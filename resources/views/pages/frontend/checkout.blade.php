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
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="section-top-select-text checkout-section-top-select-section">
    <div class="container">
        <div class="section-select-top-ul-section">
            <div class="row justify-content-lg-center">
                <div class="col-md-12">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="section-top-select-ul-selection">
                                <ul>
                                    <li class="active-select-ul">MY BAG</li>
                                    <span>- - - - - - - - - - - - -</span>
                                    <li class="active-select-ul">ADDRESS</li>
                                    <span>- - - - - - - - - - - - -</span>
                                    <li>PAYMENT</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="delivery-to-address-section">
    <div class="add-new-address-section add-new-address-btn-responsive">
        <button data-bs-toggle="modal" data-bs-target="#new-addressModal">
            <div class="add-new-address-icon">
                <i class="fa-regular fa-circle-plus"></i>
            </div>
            <div class="add-new-address-text">
                <h6>Add New Address</h6>
            </div>
        </button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="row g-md-3 justify-content-center">
                    <div class="col-md-12">
                        <div class="address-section-header-text">
                            <h5>Delivery To</h5>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row saved_address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="add-new-address-section add-new-address-btn-desktop">
                            <button class="add_new_address_button">
                                <div class="add-new-address-icon">
                                    <i class="fa-regular fa-circle-plus"></i>
                                </div>
                                <div class="add-new-address-text">
                                    <h6>Add New Address</h6>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="place-order-section">
                    <div class="billing-details">
                        <div class="billing-details-header-text">
                            <h5>BILLING DETAILS</h5>
                        </div>
                        <div class="billing-price-section">
                            <ul>
                                <li>Cart Total <span class="price-text">₹ {{$order_price}}</span></li>
                                <li>Discount <span class="discount-text">- ₹ {{$discount}}</span></li>
                                <!-- <li>GST <span class="gst-text">₹ 44.95</span></li> -->
                                <li>Shipping Charges <span class="shipping-text">₹ {{$shipping_fee}}</span></li>
                                <li>Total Amount <span class="price-text">₹ {{$final_price}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <a href="javascript:void(0);" class="confirm_order">Confirm Order</a>
                        <form id="submitForm" action="{{ route('payment') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="shipping_fee" class="shipping_fee" value="{{$shipping_fee}}">
                            <input type="hidden" name="total_price" class="total_price" value="{{$order_price}}">
                            <input type="hidden" name="discount" class="discount" value="{{$discount}}">
                            <input type="hidden" name="promocode_id" class="promocode_id" value="{{$promo_code_id}}">
                            <input type="hidden" name="final_amount" class="final_amount" value="{{$final_price}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <----------------- section End--------------->

<!-- add address popup section start-->
<div class="modal fade" id="new-addressModal" tabindex="-1" aria-labelledby="new-addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-addressModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutAddressForm" class="new-address-form-section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="use-current-location-btn">
                                <a href="javascript:void(0);"><i class="fa-light fa-location-crosshairs"></i> &nbsp;Use my
                                    current location</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="new-address-form-input">
                                <input type="text" name="first_name" class="first_name" placeholder="First Name*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="new-address-form-input">
                                <input type="text" name="last_name" class="last_name" placeholder="Last Name*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="new-address-form-input">
                                <input type="text" name="house_no" class="house_no" placeholder="House No., Building Name *">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="new-address-form-input">
                                <input type="text" name="street_name" class="street_name" placeholder="Street Name, Area*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="new-address-form-input">
                                <input type="text" name="landmark" class="landmark" placeholder="Landmark">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="new-address-form-input">
                                <input type="text" name="postal_code" class="postal_code" placeholder="Postal Code*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="new-address-form-input">
                                <input type="text" name="city_district" class="city_district" placeholder="City, District *">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="new-address-form-input">
                                <select name="country" class="country" id="">
                                    <option disabled selected>Select Country</option>
                                    <option value="India">India</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="new-address-form-input">
                                <select name="state" class="state" required="required">
                                    <option disabled selected="selected">Select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="new-address-form-input">
                                <input type="text" name="phone_no" class="phone_no" placeholder="Phone No*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="product-section-check-box save-an-additional-section">
                                <input type="checkbox" id="combos" class="default_address">
                                <label for="combos">Make this my default address</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-success save_address">Save</button>
                <input type="hidden" name="edit_address_id" class="edit_address_id" value="">
            </div>
            <div class="alert address_resp"></div>
        </div>
    </div>
</div>
<!-- add address popup section end-->
@stop

@push('scripts')
<script>
fetch_saved_address();
$(document).on('click', '.add_new_address_button', function(e) {
    $('#new-addressModalLabel').text('Add New Address');
    $('.save_address').addClass('add_address_btn').removeClass('update_address_btn');
    $('.address_resp').removeClass('alert-success').html('');
    $("#checkoutAddressForm")[0].reset();
    $('#new-addressModal').modal('show');
});

$(document).on('click', '.update_address_button', function(e) {
    $('#new-addressModalLabel').text('Edit Address');
    $('.save_address').removeClass('add_address_btn').addClass('update_address_btn');
    $('.address_resp').removeClass('alert-success').html('');
    $("#checkoutAddressForm")[0].reset();
    var address_id = $(this).attr('address_id');

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('fetch_address_for_edit') }}",
        method: 'POST',
        data: {_token: _token, address_id:address_id},
        success: function (data) {
            var address_details = data.address_details;

            $('.first_name').val(address_details.first_name);
            $('.last_name').val(address_details.last_name);
            $('.house_no').val(address_details.house_no);
            $('.street_name').val(address_details.street_name);
            $('.landmark').val(address_details.landmark);
            $('.postal_code').val(address_details.postal_code);
            $('.city_district').val(address_details.city_district);
            $('.phone_no').val(address_details.phone_no);
            $('.country').val(address_details.country);
            $('.state').val(address_details.state);
            $('.edit_address_id').val(address_details.id);

            if(address_details.default_address == '1'){
                $('.default_address').prop('checked', true);
            }else{
                $('.default_address').prop('checked', false);
            }

            $('#new-addressModal').modal('show');
        }
    });
});

$(document).on('click', '.add_address_btn', function(e) {
    if(validate_form() == true){
        var first_name = $('.first_name').val();
        var last_name = $('.last_name').val();
        var house_no = $('.house_no').val();
        var street_name = $('.street_name').val();
        var landmark = $('.landmark').val();
        var postal_code = $('.postal_code').val();
        var city_district = $('.city_district').val();
        var phone_no = $('.phone_no').val();
        var country = $('.country').val();
        var state = $('.state').val();

        if($('.default_address:checkbox:checked').length > 0){
            var is_default = 1;
        }else{
            var is_default = 0;
        }

        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('save_checkout_address') }}",
            method: 'POST',
            data: {_token: _token, first_name:first_name, last_name:last_name, house_no:house_no, street_name:street_name, landmark:landmark, postal_code:postal_code, city_district:city_district, phone_no:phone_no, country:country, state:state, is_default:is_default},
            success: function (data) {
                $('.address_resp').addClass('alert-success').html(data.msg);
                fetch_saved_address();
                setTimeout(function() {
                    $('#new-addressModal').modal('hide');
                }, 2000);
            }
        });
    }
});

$(document).on('click', '.update_address_btn', function(e) {
    if(validate_form() == true){
        var first_name = $('.first_name').val();
        var last_name = $('.last_name').val();
        var house_no = $('.house_no').val();
        var street_name = $('.street_name').val();
        var landmark = $('.landmark').val();
        var postal_code = $('.postal_code').val();
        var city_district = $('.city_district').val();
        var phone_no = $('.phone_no').val();
        var country = $('.country').val();
        var state = $('.state').val();
        var address_id = $('.edit_address_id').val();

        if($('.default_address:checkbox:checked').length > 0){
            var is_default = 1;
        }else{
            var is_default = 0;
        }

        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('edit_checkout_address') }}",
            method: 'POST',
            data: {_token: _token, address_id:address_id, first_name:first_name, last_name:last_name, house_no:house_no, street_name:street_name, landmark:landmark, postal_code:postal_code, city_district:city_district, phone_no:phone_no, country:country, state:state, is_default:is_default},
            success: function (data) {
                if(data.status == true){
                    $('.address_resp').addClass('alert-success').html(data.msg);
                    fetch_saved_address();
                    setTimeout(function() {
                        $('#new-addressModal').modal('hide');
                    }, 2000);
                }
            }
        });
    }
});

$(document).on('change', '.radioshow', function(e) {
	var val = $(this).attr('data-class');
	$('.allshow').hide();
	$('.' + val).show();
});

$(document).on('click', '.remove_address_button', function(e) {
    var address_id = $(this).attr('address_id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('delete_saved_address') }}",
            method: 'POST',
            data: {_token: _token, address_id:address_id},
            success: function (data) {
                if(data.status == true){
                    fetch_saved_address();
                    Swal.fire(
                    'Deleted!',
                    'Your address has been deleted.',
                    'success'
                    );
                }
            }
        });
    }
    })
});

$(document).on('click', '.confirm_order', function(e) {
    const theForm = $('#submitForm');
    theForm.submit();
});

function validate_form(){
    var valid = true;
    var first_name = $('.first_name').val();
    var last_name = $('.last_name').val();
    var house_no = $('.house_no').val();
    var street_name = $('.street_name').val();
    var landmark = $('.landmark').val();
    var postal_code = $('.postal_code').val();
    var city_district = $('.city_district').val();
    var phone_no = $('.phone_no').val();
    var country = $('.country').val();
    var state = $('.state').val();
    

    if(first_name == ""){
        valid = false;
        $('.first_name').css('border-color', 'red');
    }else{
        $('.first_name').css('border-color', '');
    }

    if(last_name == ""){
        valid = false;
        $('.last_name').css('border-color', 'red');
    }else{
        $('.last_name').css('border-color', '');
    }

    if(house_no == ""){
        valid = false;
        $('.house_no').css('border-color', 'red');
    }else{
        $('.house_no').css('border-color', '');
    }

    if(street_name == ""){
        valid = false;
        $('.street_name').css('border-color', 'red');
    }else{
        $('.street_name').css('border-color', '');
    }

    if(landmark == ""){
        valid = false;
        $('.landmark').css('border-color', 'red');
    }else{
        $('.landmark').css('border-color', '');
    }

    if(postal_code == ""){
        valid = false;
        $('.postal_code').css('border-color', 'red');
    }else{
        $('.postal_code').css('border-color', '');
    }

    if(city_district == ""){
        valid = false;
        $('.city_district').css('border-color', 'red');
    }else{
        $('.city_district').css('border-color', '');
    }

    if(phone_no == ""){
        valid = false;
        $('.phone_no').css('border-color', 'red');
    }else{
        $('.phone_no').css('border-color', '');
    }

    if(country == null){
        valid = false;
        $('.country').css('border-color', 'red');
    }else{
        $('.country').css('border-color', '');
    }

    if(state == null){
        valid = false;
        $('.state').css('border-color', 'red');
    }else{
        $('.state').css('border-color', '');
    }
    
    return valid;
}

function fetch_saved_address(){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('fetch_saved_address') }}",
        method: 'POST',
        data: {_token: _token},
        success: function (data) {
            $('.saved_address').html('');
            var addresses = data.addresses;
            for(var i=0; i<addresses.length; i++){
                var single_address = addresses[i];
                var is_checked = "";
                var edit_btn_visible = ' style="display: none;"';
                if(single_address.default_address == '1'){
                    is_checked = " checked";
                    edit_btn_visible = '';
                }
                var address_html = 
                '<div class="col-md-6 address_item_'+single_address.id+'">'+
                    '<div class="checkout-address-details-total-section">'+
                        '<label for="address'+i+'">'+
                            '<input class="radioshow" type="radio" id="address'+i+'" name="address" data-class="div'+i+'" value="'+single_address.id+'" '+is_checked+'>'+
                            '<span>'+
                                '<div class="address-details-section">'+
                                    '<h6>'+
                                        '<div class="home-text-batch">'+
                                            '<p>Home</p>'+
                                        '</div>'+single_address.first_name+' '+single_address.last_name+''+
                                    '</h6>'+
                                    '<p>'+single_address.house_no+' '+single_address.street_name+'</p>'+
                                    '<p>'+single_address.city_district+' - '+single_address.postal_code+'</p>'+
                                    '<p>Mobile : <span class="mobile-text-number">'+single_address.phone_no+'</span></p>'+
                                '</div>'+
                                '<div class="edit-remove-btn allshow div'+i+'" '+edit_btn_visible+'>'+
                                    '<button class="update_address_button" address_id="'+single_address.id+'">Edit</button>'+
                                    '<button class="remove_address_button" address_id="'+single_address.id+'">Remove</button>'+
                                '</div>'+
                            '</span>'+
                        '</label>'+
                    '</div>'+
                '</div>';
                $('.saved_address').append(address_html);
            }
        }
    });
}
</script>
@endpush