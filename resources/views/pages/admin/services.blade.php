@extends('layouts.admin')
@section('content')

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> All Services</h1>
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
                     <div class="col-lg-2">
                        <div class="form-group">
                           <label>From Date</label>
                           <input type="text" name="" class="form-control from_date" value="">
                        </div>
                     </div>

                     <div class="col-lg-2">
                        <div class="form-group">
                           <label>To Date</label>
                           <input type="text" name="" class="form-control to_date" value="">
                        </div>
                     </div>
                     <div class="col-lg-3">
                        <div class="form-group apply-clear-btn">
                            <button type="button" class="btn btn-outline-success apply_filter">Apply</button>
                            <button type="button" class="btn btn-outline-danger clear_filter">Clear</button>
                        </div>
                     </div>
    
                </div>
            </div>
    
            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                @include('pages.admin.services-child') 
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
    var from_date = $('.from_date').val();
    var to_date = $('.to_date').val();
    var search_key = $('.search_key').val();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('filtering_service_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, from_date:from_date, to_date:to_date, search_key:search_key, column:column, order_by:order_by},
        success: function (data) { 
            $('#all-orders').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }

    }); 
}
</script>

@endpush