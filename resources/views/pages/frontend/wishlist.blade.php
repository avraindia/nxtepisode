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
                        <h1>Wishlist</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->

<!-- <----------------- section start--------------->
<section class="product-list-section product-wishlist-section">
    <div class="container wishlist-body">
        @include('pages.frontend.wishlist-child')  
    </div>
</section>
<!-- <----------------- section End--------------->
@stop

@push('scripts')
<script>
$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    if(page!=""){
        getFilteringBody(page);
    }
});

$(document).on('click', '.remove_wishlist_item', function(e) {
    var product_id = $(this).attr('product_id');
    var wish_cookie = getCookie("nextProductWishCollection"); 
    var wishlist_arr = wish_cookie.split(',');
    var index = wishlist_arr.indexOf(product_id);
    if (index > -1) {
        wishlist_arr.splice(index, 1);
    }
    var new_wishlist = wishlist_arr.join(',');
    setCookie('nextProductWishCollection', new_wishlist, 365);

    getFilteringBody(1);
});

function getFilteringBody(page){
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('filtering_wishlist_result') }}",
        method: 'POST',
        data: {_token: _token, page:page},
        success: function (data) { 
            $('.wishlist-body').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }
    });
}
</script>
@endpush