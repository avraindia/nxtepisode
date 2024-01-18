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
                            <!--
                                Ratio A => UNMISSABLE COLLECTION
                                Ratio B => SHOP BY THEMES
                                Ratio C => STRAIGHT FORM HOLLYWOOD
                                Ratio D => TRENDING CATEGORIES
                            -->
                            <div class="col-lg-6">
                                <div class="form-group image_ratio_area" style="display:none;">
                                    <label class="label">Image Ratio</label>
                                    <select class="form-select select image_ratio" name="image_ratio">
                                        <option value="">Select Image Ratio</option>
                                        <option value="A">Ratio A</option>
                                        <option value="B">Ratio B</option>
                                        <option value="C">Ratio C</option>
                                        <option value="D">Ratio D</option>
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
        var image_ratio = $('.image_ratio').val();
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
            if(image_ratio == ""){
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