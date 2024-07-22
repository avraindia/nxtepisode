@extends('layouts.admin')
@section('content')

<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Homepage Section</h1>
                </div>
            </div>
            <form method="post" id="submitForm" action="{{ route('save_homepage_section') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Section name</label>
                                    <input type="text" class="form-control section_name" value="" name="section_name" required>
                                    <label class="input-error section_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Section type</label>
                                    <select class="form-select select section_type" name="section_type">
                                        <option value="">Section section type</option>
                                        <option value="collection">Collection</option>
                                        <option value="product">Product</option>
                                    </select>
                                    <label class="input-error section_type_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                    
                            <div class="col-lg-6">
                                <div class="form-group image_ratio_area" style="display:none;">
                                    <label class="label">Slider Type</label>

                                    <select class="form-select select collection_slider_type" name="collection_slider_type" style="display:none;">
                                        <option value="">Select Slider Type</option>
                                        <option value="A">Slider with 1 image (Page Top Slider)</option>
                                        <option value="L">Slider with 1 image (Page Middle Slider)</option>
                                        <option value="B">Slider with 3 square images</option>
                                        <option value="C">Slider with 4 horizontally rectangle images</option>
                                        <option value="K">Slider with 4 vertically rectangle images</option>
                                        <option value="D">Slider with 4 rectangle images with ordering number(e.g. Top 5 or Top 10)</option>
                                        <option value="E">Slider with 4 square images without title</option>
                                        <option value="J">Slider with 4 square images with title</option>
                                        <option value="F">Slider with 4 circle images</option>
                                    </select>

                                    <select class="form-select select product_slider_type" name="product_slider_type" style="display:none;">
                                        <option value="">Select Slider Type</option>
                                        <option value="G">Slider with 1 image</option>
                                        <option value="H">Slider with 5 rectangle images</option>
                                        <option value="I">Slider with 5 rectangle images of flash sale</option>
                                    </select>
                                    <label class="input-error image_ratio_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Section order</label>
                                    <input type="text" class="form-control section_order" value="" name="section_order" required>
                                    <label class="input-error section_order_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Publish this section</label>
                                        <input type="checkbox" class="switch is_active" name="is_active" checked>
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
        <button type="button" class="btn-theme-blue save_section_btn">Save</button>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">

$(function() {
    $('.input-error').hide();

    $(document).on("click",".save_section_btn",function() {
        var valid = true;
        $('.input-error').hide();
        var section_name = $('.section_name').val();
        var section_type = $('.section_type').val();
        var collection_slider_type = $('.collection_slider_type').val();
        var product_slider_type = $('.product_slider_type').val();
        var section_order = $('.section_order').val();
        
        if(section_name == ""){
            valid = false;
            $('.section_name_err').show();
        }else{
            $('.section_name_err').hide();
        }

        if(section_type == ""){
            valid = false;
            $('.section_type_err').show();
        }else{
            $('.section_type_err').hide();
        }

        if(section_type == "collection"){
            if(collection_slider_type == ""){
                valid = false;
                $('.image_ratio_err').show();
            }else{
                $('.image_ratio_err').hide();
            }
        }

        if(section_type == "product"){
            if(product_slider_type == ""){
                valid = false;
                $('.image_ratio_err').show();
            }else{
                $('.image_ratio_err').hide();
            }
        }

        if(section_order == ""){
            valid = false;
            $('.section_order_err').show();
        }else{
            $('.section_order_err').hide();
        }

        if(valid == true){
            const theForm = $('#submitForm');
            theForm.submit();
        }
    });

    $(document).on("click",".section_type",function() {
        $('.image_ratio_area').hide();
        var section_type = $(this).val();
        if(section_type == 'collection'){
            $('.collection_slider_type').prop('selectedIndex',0);
            $('.image_ratio_area').show();
            $('.collection_slider_type').show();
            $('.product_slider_type').hide();
        }
        
        if(section_type == 'product'){
            $('.product_slider_type').prop('selectedIndex',0);
            $('.image_ratio_area').show();
            $('.product_slider_type').show();
            $('.collection_slider_type').hide();
        }
    });
});


</script>

@endpush