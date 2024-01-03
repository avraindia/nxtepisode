@extends('layouts.admin')
@section('content')
<div class="body">
    <div class="row g-4">
        <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="align-items-center d-md-flex justify-content-between mb-4">
                    <div class="">
                        <h1 class="card-title m-md-0 mb-3">
                        Order ID: #{{$order_details->order_number}}
                    </h1>
                    </div>
                </div>
                <div class="row order-process g-4">
                    <div class="col-lg-12">
                        <div class="order-summery p-lg-4">
                            <div class="row">
                                <div class="col-lg-7 col-sm-12 od-bdr-set">
                                    <div class="">
                                        <h1 class="address-title mb-4">Order Summery ({{$item_num}})</h1>
                                    </div>
                                    @foreach ($all_order_items as $item)
                                    <div class="ors-list">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="name left">{{$item->product_name}} </h6>
                                            <div class="tag center m-0">{{$item->product_price}} X {{$item->quantity}}</div>
                                            <div>₹{{$item->total_price}}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="border-box">
                                        
                                        <div class="d-flex pb-2 align-items-center justify-content-between">
                                            <h6 class="name left">Shipping Fee</h6>
                                            <div class="price-div">+ ₹{{number_format($order_details->shipping_fee, 2)}}</div>
                                        </div>
                                        <div class="d-flex pb-2 align-items-center justify-content-between">
                                            <h6 class="name left">Discount</h6>
                                            <div class="price-div">- ₹{{number_format($order_details->discount, 2)}}</div>
                                        </div>
                                       
                                        <div class="d-flex pb-2 pt-2 align-items-center justify-content-between">
                                            <h6 class="name left mb-0 font-20">Total Cost</h6>
                                            <div class="price-div font-20">₹{{number_format($order_details->final_price, 2)}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-12">
                                    <div class="ship-address">
                                        <h1 class="address-title mb-4">Customer Details</h1>
                                        <h6>
                                            <span>customer name</span>
                                            {{$order_details->first_name}} {{$order_details->last_name}}
                                        </h6>
                                        <h6>
                                            <span>phone number</span>
                                            {{$order_details->phone_no}}
                                        </h6>
                                        <h6>
                                            <span>email address</span>
                                            {{$order_details->email}}
                                        </h6>
                                        <h6>
                                            <span>address details</span>
                                            {{$order_details->house_no}}, {{$order_details->street_name}}, {{$order_details->postal_code}}, {{$order_details->city_district}}, {{$order_details->state_name}}
                                        </h6>
                                        <h6>
                                            <span>Landmark</span>
                                            {{$order_details->landmark}}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('pages.admin.order-details-child') 
                    <input type="hidden" class="order_id" name="order_id" value="{{$order_details->id}}">
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">

$(document).on('click', '.dispatched_button', function(e) {
    e.preventDefault();
    var valid = true;
    var length = $('.length').val();
    var beadth = $('.beadth').val();
    var height = $('.height').val();
    var weight = $('.weight').val();

    if(length == ""){
        $('.length').css({"border-color":"red", "border-width":"2px", "border-style":"solid"});
        valid = false;
    }else{
        $('.length').css({'border-color':'', 'border':''});
    }

    if(beadth == ""){
        $('.beadth').css({"border-color":"red", "border-width":"2px", "border-style":"solid"});
        valid = false;
    }else{
        $('.beadth').css({'border-color':'', 'border':''});
    }

    if(height == ""){
        $('.height').css({"border-color":"red", "border-width":"2px", "border-style":"solid"});
        valid = false;
    }else{
        $('.height').css({'border-color':'', 'border':''});
    }

    if(weight == ""){
        $('.weight').css({"border-color":"red", "border-width":"2px", "border-style":"solid"});
        valid = false;
    }else{
        $('.weight').css({'border-color':'', 'border':''});
    }

    if(valid == true){
        if (confirm("Do you want to change order status?") == true) {
            var _token = $('meta[name="csrf-token"]').attr('content');
            var order_id = $('.order_id').val();
            $.ajax({
                url: "{{ route('submit_courier') }}",
                method: 'POST',
                data: {_token: _token, order_id:order_id, length:length, breadth:beadth, height:height, weight:weight},
                success: function (data) { 
                    if(data.resp == '1'){
                        location.reload();
                    }else{
                        $('.ship_resp').addClass('alert-danger').html(data.status);
                    }
                }
            });
        }
    }
});



$(document).on('click', '.on_the_way_button', function(e) {
    if (confirm("Do you want to change order status?") == true) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var order_id = $('.order_id').val();

        $.ajax({
            url: "{{ route('order_on_way') }}",
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

$(document).on('click', '.order_delivered_button', function(e) {
    if (confirm("Do you want to change order status?") == true) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var order_id = $('.order_id').val();

        $.ajax({
            url: "{{ route('order_delivered') }}",
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

$(document).on('click', '.order_pack', function(e) {
    if (confirm("Do you want to change order status?") == true) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var order_id = $('.order_id').val();

        $.ajax({
            url: "{{ route('order_pack') }}",
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

$(document).on('click', '.cancel_order', function(e) {
    if (confirm("Do you want to change order status?") == true) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var order_id = $('.order_id').val();

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
</script>

@endpush