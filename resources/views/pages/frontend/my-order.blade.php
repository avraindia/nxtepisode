@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/swanky-purse/jquery-ui.min.css" integrity="sha512-UW0Siwc3bSH7o3YWBdUa07qoAeNRxS8HVlyyISuh2IStOK3+JW7FHKYaCCp114HXd/9PAuZAWQ/IXWh4Egg5Xw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <div class="my-order-page-product-filter-section">
                    <div class="row justify-content-md-end">
                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <div class="my-order-page-product-filter-total-section">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="new-address-form-input">
                                            <input type="text" class="from_date" placeholder="from date">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="my-order-page-product-filter-total-section">
                                            <div class="new-address-form-input">
                                                <input type="text" class="to_date" placeholder="to date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="product-size-select">
                                            <select name="status" id="status">
                                                <option value="" selected>Status</option>
                                                @foreach ($all_status as $status)
                                                <option value="{{$status->id}}">{{$status->status_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('pages.frontend.my-order-child')  
            </div>
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->
@stop

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    if(page!=""){
        my_order_filter(page);
    }
});

$( ".from_date" ).datepicker({
    dateFormat: 'dd.mm.yy',
    onSelect: function(dateText, inst) {
        my_order_filter(1);
    }
});
$( ".to_date" ).datepicker({
    dateFormat: 'dd.mm.yy',
    onSelect: function(dateText, inst) {
        my_order_filter(1);
    }
});
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
                url: "{{ route('front_cancel_order') }}",
                method: 'POST',
                data: {_token: _token, order_id:order_id},
                success: function (data) { 
                    if(data.resp == true){
                        Swal.fire({
                            icon: "success",
                            title: data.msg,
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.msg
                        });
                    }
                }
            });
        } 
    });
});

$(document).on('change', '#status', function(e) {
    var status_id = $(this).val();
    my_order_filter(1);
});

function my_order_filter(page){
    var from_date = $( ".from_date" ).val();
    var to_date = $( ".to_date" ).val();
    var status_id = $( "#status" ).val();

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('filtering_my_order') }}",
        method: 'POST',
        data: {_token: _token, page:page, from_date:from_date, to_date:to_date, status_id:status_id},
        success: function (data) { 
            $('.my-order-list').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }
    });
}
</script>
@endpush