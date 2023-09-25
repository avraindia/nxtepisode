@extends('layouts.admin')
@section('content')
<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('add_product') }}" class="primary-btn"><i class="bx bxs-plus-circle"></i> Add Product </a>
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
                    <h1 class="card-title m-md-0 mb-3"> All Products</h1>
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
                            <select class="form-control search_status">
                                <option value="">All</option>
                                @foreach($parent_categories as $parent_category)
                                <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
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
            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                @include('pages.admin.products-child')
            </div>
        </div>
    </div>
</div>
@stop



@push('scripts')

<script>
</script>

@endpush