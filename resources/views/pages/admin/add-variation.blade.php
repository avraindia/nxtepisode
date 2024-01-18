@extends('layouts.admin')
@section('content')

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Product Fitting</h1>
                </div>
            </div>
            <form id="submitForm" action="{{route('save_variation')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label class="label">Product Name : {{$product_details->product_title}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                <label class="label">Fitting Type</label>
                                    <select class="form-select select fitting_type" name="fitting_type" aria-label="Default select example" required>
                                        <option value="0" selected> Select Fitting Type</option>
                                        @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="input-error fitting_type_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> Please select fitting type</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                <label class="label">Gender</label>
                                    <select class="form-select select fitting_gender" name="fitting_gender" aria-label="Default select example" required>
                                        <option value="0" selected> Select Gender</option>
                                        @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                        @endforeach
                                    </select>
                                    <label class="input-error fitting_gender_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> Please select gender</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Fitting Title</label>
                                    <input type="text" class="form-control fitting_title" placeholder="Ex: Ironman T-shirt" value="" name="fitting_title" required>
                                    <label class="input-error fitting_title_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="label">Details</label>
                                    <textarea class="form-control" name="fitting_details" id="details"></textarea>
                                    <label class="input-error fitting_details_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="label">Description</label>
                                    <textarea class="form-control" name="fitting_description" id="description"></textarea>
                                    <label class="input-error fitting_description_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label">Fitting Image</label>
                                            <input type="file" class="form-control fitting_image" name="fitting_image[]" multiple>
                                            <label class="input-error fitting_image_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> Please select atleast one image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label">Size Chart Image</label>
                                            <input type="file" class="form-control size_chart_image" name="size_chart_image[]" multiple>
                                            <label class="input-error size_chart_image_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> Please select atleast one image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row product_gallery_list">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row chart_gallery_list">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Publish this product</label>
                                        <input type="checkbox" class="switch is_available" name="is_available" checked>
                                        <input type="hidden" name="product_id" class="product_id" value="{{$product_details->id}}">
                                        <input type="hidden" name="fitting_action" class="fitting_action" value="add">
                                        <input type="hidden" name="variation_id" class="variation_id" value="">
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
        <button type="button" class="btn-theme-blue save_variation_btn">Save</button>
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

$(document).on("click",".save_variation_btn",function() {
    var valid = true;
    var fitting_title = $('.fitting_title').val();
    var fitting_action = $('.fitting_action').val();
    var fitting_type = $('.fitting_type').find(":selected").val();
    var fitting_gender = $('.fitting_gender').find(":selected").val();
    var fitting_image_num = $('.fitting_image')[0].files.length;
    var size_chart_image_num = $('.size_chart_image')[0].files.length;

    if(fitting_title == ""){
        valid = false;
        $('.fitting_title_err').show();
    }else{
        $('.fitting_title_err').hide();
    }

    if(fitting_type == "0"){
        valid = false;
        $('.fitting_type_error').show();
    }else{
        $('.fitting_type_error').hide();
    }

    if(fitting_gender == "0"){
        valid = false;
        $('.fitting_gender_error').show();
    }else{
        $('.fitting_gender_error').hide();
    }

    if(fitting_gender == "0"){
        valid = false;
        $('.fitting_gender_error').show();
    }else{
        $('.fitting_gender_error').hide();
    }

    if(fitting_action == 'add'){
        if(fitting_image_num == "0"){
            valid = false;
            $('.fitting_image_err').show();
        }else{
            $('.fitting_image_err').hide();
        }

        if(size_chart_image_num == "0"){
            valid = false;
            $('.size_chart_image_err').show();
        }else{
            $('.size_chart_image_err').hide();
        }
    }
    
    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});

$(document).on("change",".fitting_type, .fitting_gender",function() {
    var fitting_type = $('.fitting_type').find(":selected").val();
    var fitting_gender = $('.fitting_gender').find(":selected").val();
    var product_id = $('.product_id').val();

    $('.product_gallery_list').html("");
    $('.chart_gallery_list').html("");

    if(fitting_type != "0" && fitting_gender != "0"){
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('fetch_existing_fitting_type') }}",
            method: 'POST',
            data: {_token: _token, fitting_type:fitting_type, fitting_gender:fitting_gender, product_id:product_id},
            success: function (data) { 
                if(data.resp == true){
                    if(data.is_exist == 'yes'){
                        var result = data.data;
                        $('.fitting_action').val('edit');
                        $('.variation_id').val(result.id);
                        $('.fitting_title').val(result.fitting_title);
                        $("#details").summernote("code", result.details);
                        $("#description").summernote("code", result.description);
                        var gallery_images = result.gallery_images;
                        for(var i=0; i<gallery_images.length; i++){
                            var single_img = gallery_images[i];
                            var img_html = 
                            '<div class="col-lg-3">'+
                                '<div class="variation-gal-img-container">'+
                                    '<img src="'+single_img.product_thumbnail_image_link+'" alt="Snow">'+
                                '</div>'+
                            '</div>';
                            $('.product_gallery_list').append(img_html);
                        }

                        var chart_images = result.chart_images;
                        for(var i=0; i<chart_images.length; i++){
                            var single_img = chart_images[i];
                            var img_html = 
                            '<div class="col-lg-3">'+
                                '<div class="variation-gal-img-container">'+
                                    '<img src="'+single_img.size_gallery_image_link+'" alt="Snow">'+
                                '</div>'+
                            '</div>';
                            $('.chart_gallery_list').append(img_html);
                        }

                        //console.log(result.is_active);
                        if(result.is_active == '1'){
                            $(".is_available").prop('checked', true);
                        }else{
                            $(".is_available").prop('checked', false);
                        }
                    }else{
                        $('.fitting_action').val('add');
                        $('.variation_id').val("");
                        $('.fitting_title').val("");
                        $('#details').summernote('reset');
                        $('#description').summernote('reset');
                        $(".is_available").prop('checked', true);
                    }
                }
            }
        }); 
    }else{
        $('.fitting_action').val('add');
        $('.variation_id').val("");
        $('.fitting_title').val("");
        $('#details').summernote('reset');
        $('#description').summernote('reset');
        $(".is_available").prop('checked', true);
    }
});
</script>

@endpush