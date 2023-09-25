@extends('layouts.admin')
@section('content')
<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('add_variation',$product_id) }}" class="primary-btn"><i class="bx bxs-plus-circle"></i>Manage Fittings </a>
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
                            <label>Gender</label>
                            <select class="form-control gender_id">
                                <option value="0">All</option>
                                @foreach($genders as $gender)
                                <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>Fitting Type</label>
                            <select class="form-control type_id">
                                <option value="0">All</option>
                                @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group apply-clear-btn">
                            <button type="button" class="btn btn-outline-success apply_filter">Apply</button>
                            <button type="button" class="btn btn-outline-danger clear_filter">Clear</button>
                            <input type="hidden" name="product_id" class="product_id" value="{{$product_id}}">
                        </div>
                    </div>
                </div>
            </div>
            <div id="all-list" class="table-responsive-sm position-relative withdra-tab-content active">
                @include('pages.admin.fitting-child')
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
    var gender_id = $('.gender_id').val();
    var type_id = $('.type_id').val();
    var product_id = $('.product_id').val();
    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('filtering_fitting_paginate_result') }}",
        method: 'POST',
        data: {_token: _token, page:page, search_key:search_key, gender_id:gender_id, type_id:type_id, product_id:product_id},
        success: function (data) { 
            $('#all-list').html(data);
            $('.pagination li [rel=prev]').html('Prev');
            $('.pagination li [rel=next]').html('Next');
        }

    }); 
}
</script>

@endpush