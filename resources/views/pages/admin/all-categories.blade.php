@extends('layouts.admin')
@section('content')

<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="javascript:void(0);" class="primary-btn add_category_btn"><i class="bx bxs-plus-circle"></i> Add Category </a>
            </div>
        </div>
    </div>
</section>

<!-- ======================= Border End Topbar ================== -->

<div class="body">
    <div class="card">
        <div class="card-body">

            @if (\Session::has('errmsg'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('errmsg') !!}</li>
                    </ul>
                </div>
            @endif

            @if (\Session::has('successmsg'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('successmsg') !!}</li>
                    </ul>
                </div>
            @endif

            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> 
                        @if($type =='experience')
                            Experience Category
                        @else
                            Service Category
                        @endif
                    </h1>
                </div>
            </div>

            <div class="user_filter">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="form-group">
                           <label>Search Keyword</label>
                           <input type="text" name="" class="form-control search_key" value="">
                           <input type="hidden" name="cat_type" class="cat_type" value="{{$type}}">
                        </div>
                     </div>
                     <div class="col-lg-2">
                        <div class="form-group">
                           <label>Status</label>
                           <select class="form-control search_status">
                              <option value="">All</option>
                              <option value="1">Published</option>
                              <option value="0">Unpublished</option>
                           </select>
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
                @include('pages.admin.categories-child') 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="questions" > 
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center title-area">
                    <h4 class="modal-title"></h4>
                </div>
                <form id="submitForm" method="POST" action="{{ route('save_category') }}">
                @csrf
                    <div class="form-group">
                        <label class="label">Category Name</label>
                        <input type="text" class="form-control category_name" placeholder="Ex: Category" value="" name="category_name">
                    </div>
                    <div class="form-group">
                        <label class="label"></label>
                        <div class="switch_box">
                            <label>Publish this Category</label>
                            <input type="checkbox" class="switch is_active" name="is_active" checked>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="outline-btn me-3 hide_modal">Cancel</button>
                        <button type="button" class="secondary-btn primary-btn submit_category_btn">Submit</button>
                        <input type="hidden" name="edit_cat_id" class="edit_cat_id" value="">
                        <input type="hidden" name="type" class="type" value="{{$type}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
$(document).on("click",".add_category_btn",function() {
    $('.modal-title').text('Add Category');
    $('#submitForm')[0].reset();
    $('.edit_cat_id').val('');
    $('#questions').modal('show');
});

$(document).on("click",".hide_modal",function(e) {
    e.preventDefault();
    $('#questions').modal('hide');
});

$(document).on("click",".submit_category_btn",function() {
    var valid = true;
    var category_name = $('.category_name').val();

    if(category_name == ""){
        valid = false;
        $('.category_name').css('border-color', 'red');
    }else{
        $('.category_name').css('border-color', '');
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});

$(document).on("click",".edit_cat_btn",function() {
    $('.modal-title').text('Edit Category');
    $('#submitForm')[0].reset();

    var _token = $('meta[name="csrf-token"]').attr('content');
    var cat_id = $(this).attr('cat_id');

    $.ajax({
        url: "{{ route('category_details') }}",
        method: 'POST',
        data: {_token: _token, cat_id:cat_id},
        success: function (data) { 
            if(data.status == true){
                var category_details = data.category_details;
                $('.edit_cat_id').val(category_details.id);
                $('.category_name').val(category_details.name);
                if(category_details.is_active == '1'){
                    $( ".is_active" ).prop( "checked", true );
                }else{
                    $( ".is_active" ).prop( "checked", false );
                }
                $('#questions').modal('show');
            }
        }
    });
});

$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

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
    var cat_type = $('.cat_type').val();
    var search_key = $('.search_key').val();
    var search_status = $('.search_status').val();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('filtering_category_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, cat_type:cat_type, search_key:search_key, search_status:search_status, column:column, order_by:order_by},
        success: function (data) { 
            $('#all-orders').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }

    }); 
}


</script>
@endpush