@extends('layouts.admin')
@section('content')

<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Public Opinion</h1>
                </div>
            </div>
            <form method="post" id="submitForm" action="{{ route('save_public_opinion') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Public Opinion</label>
                                    <textarea class="form-control public_opinion" rows="4" name="public_opinion" required></textarea>
                                    <label class="input-error public_opinion_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label">Public Image</label>
                                            <input type="file" class="form-control public_image" name="public_image">
                                            <label class="input-error public_image_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label">Opinion Order</label>
                                            <input type="text" class="form-control opinion_order" placeholder="" value="" name="opinion_order" required>
                                            <label class="input-error opinion_order_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
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
        <button type="button" class="btn-theme-blue save_opinion_btn">Save</button>
    </div>
</div>
@stop

@push('scripts')

<script type="text/javascript">

$(function() {
    $('.input-error').hide();
    $(document).on("click",".save_opinion_btn",function() {
        var valid = true;
        var public_opinion = $('.public_opinion').val();
        var opinion_order = $('.opinion_order').val();
        var num_of_images = $(".public_image")[0].files.length;
        $('.input-error').hide();

        if(public_opinion == ""){
            valid = false;
            $('.public_opinion_err').show();
        }else{
            $('.public_opinion_err').hide();
        }

        if(opinion_order == ""){
            valid = false;
            $('.opinion_order_err').show();
        }else{
            $('.opinion_order_err').hide();
        }

        if(num_of_images == 0){
            valid = false;
            $('.public_image_err').show();
        }else{
            $('.public_image_err').hide();
        }

        if(valid == true){
            const theForm = $('#submitForm');
            theForm.submit();
        }
    });
});



</script>

@endpush