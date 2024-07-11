@extends('layouts.admin')
@section('content')

<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('add_user') }}" class="primary-btn add_user_btn"><i class="bx bxs-plus-circle"></i> Add User </a>
            </div>
        </div>
    </div>
</section>
@if(session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
@endif
<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> All Users</h1>
                </div>
            </div>
            <div class="user_filter">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="form-group">
                           <label>Search Keyword</label>
                           <input type="text" name="" class="form-control search_key" value="">
                        </div>
                     </div>
                    <div class="col-lg-2 col-sm-2">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control filter_by_gender">
                                <option value="">All</option>
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="text" name="" class="form-control from_date" value="">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="text" name="" class="form-control to_date" value="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <div class="form-group apply-clear-btn">
                            <button type="button" class="btn btn-outline-success apply_filter">Apply</button>
                            <button type="button" class="btn btn-outline-danger clear_filter">Clear</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                @include('pages.admin.users-child') 
            </div>
        </div>
    </div>
</div>

@stop
@push('scripts')

<script>
$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

$(".from_date").datepicker({ dateFormat: 'dd.mm.yy' });
$(".to_date").datepicker({ dateFormat: 'dd.mm.yy' });

$(document).on('click', '.apply_filter', function(){
    get_filtering_body(1);
});

$(document).on('click', '.clear_filter', function(){
    location.reload();
});

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    if(page!=""){
        get_filtering_body(page);
    }
});

var column = '';
var order_by = '';
$(document).on('click', '.sort_item', function(e) {
    var column_name = $(this).attr('item');
    if(column_name == column){
        if(order_by == 'asc'){
            order_by = 'desc';
        }else{
            order_by = 'asc';
        }
    }else{
        order_by = 'desc';
    }
    column = column_name;
    get_filtering_body(1)
});

function get_filtering_body(page){
    var filter_by_gender = $('.filter_by_gender').val();
    var from_date = $('.from_date').val();
    var to_date = $('.to_date').val();
    var search_key = $('.search_key').val();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('filtering_user_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, from_date:from_date, to_date:to_date, search_key:search_key, gender:filter_by_gender, column:column, order_by:order_by},
        success: function (data) { 
            $('#all-orders').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }

    }); 
}
    
</script>

@endpush