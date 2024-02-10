@extends('layouts.admin')
@section('content')

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> All Experiences</h1>
                </div>
                <a href="javascript:void(0);" class="btn btn-success add_report_limit_btn">Report Limit</a>
            </div>
            <div class="user_filter">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="form-group">
                           <label>Search Keyword</label>
                           <input type="text" name="" class="form-control search_key" value="">
                        </div>
                     </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                           <label>Status</label>
                           <select class="form-control search_status">
                              <option value="">All</option>
                              <option value="0">Active</option>
                              <option value="1">Blocked</option>
                           </select>
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

                     <div class="col-lg-1">
                        <div class="form-group">
                            <label>Reported experience</label>
                            <div class="switch_box">
                                <input type="checkbox" class="switch reported_experience" name="reported_experience">
                            </div>
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
                @include('pages.admin.experiences-child') 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="questions" > 
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center title-area">
                    <h4 class="modal-title">Add Report Limit Number for Block Experience</h4>
                </div>
                <form id="submitForm" method="POST" action="{{ route('save_counter') }}">
                @csrf
                    <div class="form-group">
                        <label class="label">Report Limit</label>
                        <input type="text" class="form-control report_limit" placeholder="Ex: 50" value="{{$report_limit}}" name="report_limit">
                    </div>
                    <div class="d-flex">
                        <button class="outline-btn me-3 hide_modal back_btn">Cancel</button>
                        <button type="button" class="secondary-btn primary-btn submit_report_limit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@push('scripts')

<script>
$(document).on("click",".add_report_limit_btn",function() {
    $('#questions').modal('show');
});
$(document).on("click",".hide_modal",function(e) {
    e.preventDefault();
    $('#questions').modal('hide');
});
$(document).on("click",".submit_report_limit",function() {
    var valid = true;
    var report_limit = $('.report_limit').val();

    if(report_limit == ""){
        valid = false;
        $('.report_limit').css('border-color', 'red');
    }else{
        $('.report_limit').css('border-color', '');
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});

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

$(document).on("click",".block_unblock_btn",function() {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var id_experience = $(this).attr('id_experience');
    var action = $(this).attr('action');
    $.ajax({
        url: "{{ route('block_experience') }}",
        method: 'POST',
        data: {_token: _token, id_experience:id_experience, action:action},
        success: function (data) { 
            if(data.status == true){
                location.reload();
            }
        }
    });
});

function get_filtering_body(page){
    var from_date = $('.from_date').val();
    var to_date = $('.to_date').val();
    var search_key = $('.search_key').val();
    var search_status = $('.search_status').val();
    var reported_experience = $('.reported_experience').is(':checked'); 
    if(reported_experience == true){
        var show_reported = 'yes';
    }else{
        var show_reported = 'no';
    }

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('filtering_experience_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, from_date:from_date, to_date:to_date, search_key:search_key, search_status:search_status, column:column, order_by:order_by, show_reported:show_reported},
        success: function (data) { 
            $('#all-orders').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }

    }); 
}
</script>

@endpush