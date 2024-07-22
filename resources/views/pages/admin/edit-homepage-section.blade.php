@extends('layouts.admin')
@section('content')

<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Edit Homepage Section</h1>
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
                                    <input type="text" class="form-control section_name" value="{{$section_details->section_name}}" name="section_name" required>
                                    <label class="input-error section_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Slider Type</label>
                                    <select class="form-select section_type" disabled>
                                        <option value="">Section section type</option>
                                        <option value="collection" <?php if($section_details->section_type == 'collection'){echo 'selected="selected"';}?>>Collection</option>
                                        <option value="product" <?php if($section_details->section_type == 'product'){echo 'selected="selected"';}?>>Product</option>
                                    </select>
                                    <input type="hidden" name="section_type" value="{{$section_details->section_type}}">
                                    <label class="input-error section_type_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group image_ratio_area">
                                    <label class="label">Image Ratio</label>
                                    <select class="form-select select collection_slider_type" name="collection_slider_type" <?php if($section_details->section_type == 'product'){echo 'style="display:none;"';}?>>
                                        <option value="">Select Slider Type</option>
                                        <option value="A" <?php if($section_details->image_ratio == 'A'){echo 'selected="selected"';}?>>Slider with 1 image (Page Top Slider)</option>
                                        <option value="L" <?php if($section_details->image_ratio == 'L'){echo 'selected="selected"';}?>>Slider with 1 image (Page Middle Slider)</option>
                                        <option value="B" <?php if($section_details->image_ratio == 'B'){echo 'selected="selected"';}?>>Slider with 3 square images</option>
                                        <option value="C" <?php if($section_details->image_ratio == 'C'){echo 'selected="selected"';}?>>Slider with 4 horizontally rectangle images</option>
                                        <option value="K" <?php if($section_details->image_ratio == 'K'){echo 'selected="selected"';}?>>Slider with 4 vertically rectangle images</option>
                                        <option value="D" <?php if($section_details->image_ratio == 'D'){echo 'selected="selected"';}?>>Slider with 4 rectangle images with ordering number(e.g. Top 5 or Top 10)</option>
                                        <option value="E" <?php if($section_details->image_ratio == 'E'){echo 'selected="selected"';}?>>Slider with 4 square images without title</option>
                                        <option value="J" <?php if($section_details->image_ratio == 'J'){echo 'selected="selected"';}?>>Slider with 4 square images with title</option>
                                        <option value="F" <?php if($section_details->image_ratio == 'F'){echo 'selected="selected"';}?>>Slider with 4 circle images</option>
                                    </select>

                                    <select class="form-select select product_slider_type" name="product_slider_type" <?php if($section_details->section_type == 'collection'){echo 'style="display:none;"';}?>>
                                        <option value="">Select Slider Type</option>
                                        <option value="G" <?php if($section_details->image_ratio == 'G'){echo 'selected="selected"';}?>>Slider with 1 image</option>
                                        <option value="H" <?php if($section_details->image_ratio == 'H'){echo 'selected="selected"';}?>>Slider with 5 rectangle images</option>
                                        <option value="I" <?php if($section_details->image_ratio == 'I'){echo 'selected="selected"';}?>>Slider with 5 rectangle images of flash sale</option>
                                    </select>
                                    <label class="input-error image_ratio_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Section order</label>
                                    <input type="text" class="form-control section_order" value="{{$section_details->section_order}}" name="section_order" required>
                                    <label class="input-error section_order_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                    <input type="hidden" name="section_id" value="{{$section_details->id}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Publish this section</label>
                                        <input type="checkbox" class="switch is_active" name="is_active" <?php if($section_details->is_active == '1'){echo 'checked="checked"';}?>>
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
        var section_type = $(this).val();
        if(section_type == 'collection'){
            $('.image_ratio_area').show();
        }else{
            $('.image_ratio_area').hide();
        }
    });
});


</script>

@endpush