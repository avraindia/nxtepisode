@extends('layouts.admin')
@section('content')
<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('inventory') }}" class="primary-btn"><i class="bx bxs-plus-circle"></i>Manage Stock </a>
            </div>
        </div>
    </div>
</section>

@if (\Session::has('successmsg'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('successmsg') !!}</li>
    </ul>
</div>
@endif

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Product Inventory</h1>
                </div>
            </div>
            <div class="user_filter">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="form-group">
                           <label>Search Keyword</label>
                           <input type="text" name="" class="form-control search_key" value="">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control cat_id">
                                <option value="0">All</option>
                                @foreach($parent_categories as $parent_category)
                                <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Sizes</label>
                            <select class="form-control size_id">
                                <option value="0">All</option>
                                @foreach($option_values as $option_value)
                                <option value="{{$option_value->id}}">{{$option_value->option_value}}</option>
                                @endforeach
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
            <div id="all-list" class="table-responsive-sm position-relative withdra-tab-content active">
                @include('pages.admin.inventory-child')
            </div>
        </div>
    </div>
</div>
@stop



@push('scripts')

<script>
$('.pagination li [rel=prev]').html('Prev');
$('.pagination li [rel=next]').html('Next');

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    if(page!=""){
        get_filtering_body(page);
    }
});

$(document).on('click', '.apply_filter', function(){
    get_filtering_body(1);
});

$(document).on('click', '.clear_filter', function(){
    location.reload();
});

function get_filtering_body(page){
    var search_key = $('.search_key').val();
    var cat_id = $('.cat_id').val();
    var size_id = $('.size_id').val();
    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('filtering_inventory_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, search_key:search_key, cat_id:cat_id, size_id:size_id},
        success: function (data) { 
            $('#all-list').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }

    }); 
}
</script>

@endpush