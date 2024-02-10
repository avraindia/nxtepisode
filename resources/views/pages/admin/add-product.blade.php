@extends('layouts.admin')
@section('content')

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Product</h1>
                </div>
            </div>
            <form id="submitForm" action="{{route('save_product')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Product Title</label>
                                    <input type="text" class="form-control product_name" placeholder="Ex: Ironman T-shirt" value="" name="product_name" required>
                                    <label class="input-error product_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                <label class="label">Product Category</label>
                                    <select class="form-select select product_main_catergory" name="product_main_catergory" aria-label="Default select example" required>
                                        <option value="0" selected> Select Category</option>
                                        @foreach($parent_categories as $parent_category)
                                        <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="input-error product_category_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> Please select category</label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="label">Product MRP.</label>
                                    <input type="text" class="form-control product_mrp" placeholder="Ex: 100.00" value="" name="product_mrp" required>
                                    <label class="input-error product_mrp_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="label">Product GST.</label>
                                    <input type="text" class="form-control product_gst" value="0" name="product_gst" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="label">Product Theme</label>
                                    <select id="demo" multiple="multiple" name="theme_id[]">
                                    @foreach($all_themes as $theme)
                                        <option value="{{$theme->id}}">{{$theme->theme_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Publish this product</label>
                                        <input type="checkbox" class="switch" name="is_available" checked>
                                        <input type="hidden" name="page_name" value="add_fabric_page">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="bottom">
    <div class="d-flex justify-content-end">
        <button class="btn-theme-blue me-3 back_btn">Cancel</button>
        <button type="button" class="btn-theme-blue save_product_btn">Save</button>
    </div>
</div>

@stop
@push('scripts')
<script type="text/javascript">
$(function() {
    $('#demo').multiselect({
        includeSelectAllOption: true,
    });
    $('.input-error').hide();
});

$(document).on("click",".save_product_btn",function() {
    var valid = true;
    var product_name = $('.product_name').val();
    var product_main_catergory = $('.product_main_catergory').find(":selected").val();
    var product_mrp = $('.product_mrp').val();

    if(product_name == ""){
        valid = false;
        $('.product_name_err').show();
    }else{
        $('.product_name_err').hide();
    }

    if(product_main_catergory == "0"){
        valid = false;
        $('.product_category_error').show();
    }else{
        $('.product_category_error').hide();
    }

    if(product_mrp == ""){
        valid = false;
        $('.product_mrp_err').show();
    }else{
        $('.product_mrp_err').hide();
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});
</script>

@endpush