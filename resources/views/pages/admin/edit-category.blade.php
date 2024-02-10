@extends('layouts.admin')



@section('content')

<div class="body">

    <div class="card">

        <div class="card-body">

            <div class="align-items-center d-md-flex justify-content-between mb-4">

                <div class="">

                    <h1 class="card-title m-md-0 mb-3"> Edit Category</h1>

                </div>

            </div>

            <form method="post" id="submitForm" action="{{ route('update_category') }}" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-lg-6 col-sm-12">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="form-group">

                                    <label class="label">Category name</label>

                                    <input type="text" class="form-control cat_name" placeholder="Ex: FIRST100" value="{{$category_details->name}}" name="cat_name" required>

                                    <input type="hidden" name="cat_id" value="{{$category_details->id}}">

                                    <label class="input-error cat_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>

                                </div>

                            </div>

                            @if ($category_details->parent_id != '0')

                            <div class="col-lg-6 col-md-6">

                                <div class="form-group">

                                    <label class="label">Parent Category</label>

                                    <select class="form-select select" aria-label="Default select example" name="parent_cat_id">

                                        <option selected value="0"> Select Category </option>

                                        @foreach($parent_categories as $parent_category)

                                        <option value="{{$parent_category->id}}" @if($parent_category->id == $category_details->parent_id) selected  @endif>{{$parent_category->name}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="form-group">

                                            <label class="label">Category Image</label>

                                            <input type="file" class="form-control category_image" name="category_image">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12">

                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="form-group">

                                            <img src="{{$category_details->category_image_link}}" class="category_img_show">

                                        </div>

                                    </div>

                                </div>

                            </div>
                            @else
                            <input type="hidden" name="parent_cat_id" value="0">
                            @endif

                        </div>

                    </div>



                    <div class="col-lg-6 col-sm-12">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="form-group">

                                    <label class="label">Category Description</label>

                                    <textarea class="form-control" name="description" id="description">{{$category_details->description}}</textarea>

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

        <button type="button" class="btn-theme-blue save_category_btn">Save</button>

    </div>

</div>

@stop

@push('scripts')

<script type="text/javascript">

$(function() {

    $('.input-error').hide();

  $("#description").summernote({

    height:300,

  });

  $("#video_decription").summernote({

height:200,

});

    $(document).on("click",".save_category_btn",function() {

        var valid = true;

        var cat_name = $('.cat_name').val();

        $('.cat_name_err').hide();

        if(cat_name == ""){

            valid = false;

            $('.cat_name_err').show();

        }else{

            $('.cat_name_err').hide();

        }



        if(valid == true){

            const theForm = $('#submitForm');

            theForm.submit();

        }

    });

  $("button#btnToggleStyle").on("click", function(e) {

    e.preventDefault();

    var styleEle = $("style#fixed");

    if (styleEle.length == 0)

      $("<style id=\"fixed\">.note-editor .dropdown-toggle::after { all: unset; } .note-editor .note-dropdown-menu { box-sizing: content-box; } .note-editor .note-modal-footer { box-sizing: content-box; }</style>")

      .prependTo("body");

    else

      styleEle.remove();

  })

});



</script>

@endpush