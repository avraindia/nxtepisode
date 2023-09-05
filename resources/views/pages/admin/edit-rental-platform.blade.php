@extends('layouts.admin')

@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Edit Rental Platform</h1>
                </div>
            </div>
            <form method="post" id="submitForm" action="{{ route('update_rental_platform') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-7 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Platform name</label>
                                <input type="text" class="form-control platform_name" placeholder="Ex: FIRST100" value="{{$platform_details->platform_name}}" name="platform_name" required>
                                <label class="input-error platform_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="label">Platform icon</label>
                                <input type="file" class="form-control platform_icon" value="" name="platform_icon" required>
                                <label class="input-error platform_icon_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="label"></label>
                                <div class="switch_box">
                                    <label>Publish this Platform</label>
                                    <input type="checkbox" class="switch" name="is_available" @if($platform_details->is_active == 1) checked  @endif>
                                    <input type="hidden" name="platform_id" value="{{$platform_details->id}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <img src="{{$platform_details->platform_media_link}}">
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
        <button type="button" class="btn-theme-blue save_platform_btn">Save</button>
    </div>
</div> 
@stop

@push('scripts')
<script type="text/javascript">
$(function() {
    $('.input-error').hide();

});
$(document).on("click",".save_platform_btn",function() {
    var valid = true;
    var platform_name = $('.platform_name').val();

    if(platform_name == ""){
        valid = false;
        $('.platform_name_err').show();
    }else{
        $('.platform_name_err').hide();
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }

});
</script>
@endpush