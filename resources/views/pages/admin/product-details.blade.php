@extends('layouts.admin')
@section('content')

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Product Details</h1>
                </div>
            </div>
            <form id="submitForm" action="{{route('update_product')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Product Title</label>
                                    <input type="text" class="form-control product_name" placeholder="Ex: Ironman T-shirt" value="{{$product_details->product_title}}" name="product_name" required>
                                    <label class="input-error product_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                    <input type="hidden" name="product_id" value="{{$product_details->id}}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                <label class="label">Product Category</label>
                                    <select class="form-select select product_main_catergory" name="product_main_catergory" aria-label="Default select example" required>
                                        <option value="0" selected> Select Category</option>
                                        @foreach($parent_categories as $parent_category)
                                        <option value="{{$parent_category->id}}" @if($parent_category->id == $product_details->main_cat_id) selected  @endif>{{$parent_category->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="input-error product_category_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> Please select category</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Product MRP.</label>
                                    <input type="text" class="form-control product_mrp" placeholder="Ex: 100.00" value="{{$product_details->product_mrp}}" name="product_mrp" required>
                                    <label class="input-error product_mrp_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            @php
                            $theme_ids = $product_details->theme_ids;
                            $theme_id_arr = explode(',', $theme_ids);
                            @endphp
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="label">Product Theme</label>
                                    <select id="demo" multiple="multiple" name="theme_id[]">
                                    @foreach($all_themes as $theme)
                                        @php
                                        $is_check = '';
                                        if(in_array($theme->id, $theme_id_arr)){
                                            $is_check = ' selected';
                                        }
                                        @endphp
                                        <option value="{{$theme->id}}" {{$is_check}}>{{$theme->theme_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Publish this product</label>
                                        <input type="checkbox" class="switch" name="is_available" @if($product_details->status == 1) checked  @endif>
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
        <button class="btn-theme-blue me-3">Cancel</button>
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
    $("#details").summernote({
        height:300,
        dialogsInBody: true
    });
    $("#description").summernote({
        height:300,
        dialogsInBody: true
    });

    $('.multiselect').focusin(function(){
        $(this).closest('.btn-group').find('.dropdown-menu').toggle();
    });

    $(document).on("click",function(e) {
        if (!$(e.target).hasClass('multiselect')) {
            $('.dropdown-menu').hide();
        }
    });

    $('#details, #description').on('summernote.paste', function(e, ne) {
		var bufferText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData('text/html');
		ne.preventDefault();
		var div = $('<div />');
		div.append(bufferText);
		div.find('*').removeAttr('style');
		setTimeout(function () {
			document.execCommand('insertHtml', false, div.html());
		}, 10);
	});
});

$(document).on("click",".save_product_btn",function() {
    var valid = true;
    var product_name = $('.product_name').val();
    var description = $($('#description').summernote('code')).text();
    var details = $($('#details').summernote('code')).text();
    var product_main_catergory = $('.product_main_catergory').find(":selected").val();
    var product_gender = $('.product_gender').find(":selected").val();
    var product_mrp = $('.product_mrp').val();

    if(product_name == ""){
        valid = false;
        $('.product_name_err').show();
    }else{
        $('.product_name_err').hide();
    }

    if(description == ""){
        valid = false;
        $('.product_description_err').show();
    }else{
        $('.product_description_err').hide();
    } 

    if(details == ""){
        valid = false;
        $('.product_details_err').show();
    }else{
        $('.product_details_err').hide();
    } 

    if(product_main_catergory == "0"){
        valid = false;
        $('.product_category_error').show();
    }else{
        $('.product_category_error').hide();
    }

    if(product_gender == "0"){
        valid = false;
        $('.product_gender_error').show();
    }else{
        $('.product_gender_error').hide();
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

$(document).on("click",".delete-cross-btn",function() {
    if (confirm("Do you want to delete this image?") == true) {
        var image_id = $(this).attr('image_id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        formdata = new FormData();
        formdata.append("_token", _token);
        formdata.append("image_id", image_id);
        $.ajax({
            data: formdata,
            method: "POST",
            url: "{{ route('delete_product_image') }}",
            contentType: false,
            processData: false,
            success: function(data) {
                if(data.status == true){
                    $('.product_img_'+image_id).remove();
                }
            }
        });
    }
});
</script>

@endpush