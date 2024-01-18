@extends('layouts.admin')
@section('content')

<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Collection Item</h1>
                </div>
            </div>
            <form method="post" id="submitForm" action="{{ route('save_collection_item') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Collection Item name</label>
                                    <input type="text" class="form-control collection_name" placeholder="Ex: FIRST100" value="" name="collection_name" required>
                                    <label class="input-error collection_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <input type="hidden" name="section_id" value="{{$section_id}}">
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label">Collection Item Image</label>
                                            <input type="file" class="form-control collection_image" name="collection_image">
                                            <label class="input-error collection_image_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label">Collection Item Order</label>
                                            <input type="text" class="form-control collection_order" placeholder="" value="" name="collection_order" required>
                                            <label class="input-error collection_order_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
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
        <button type="button" class="btn-theme-blue save_collection_btn">Save</button>
    </div>
</div>
@stop

@push('scripts')

<script type="text/javascript">

$(function() {
    $('.input-error').hide();
    $(document).on("click",".save_collection_btn",function() {
        var valid = true;
        var collection_name = $('.collection_name').val();
        var collection_order = $('.collection_order').val();
        var num_of_images = $(".collection_image")[0].files.length;
        $('.input-error').hide();

        if(collection_name == ""){
            valid = false;
            $('.collection_name_err').show();
        }else{
            $('.collection_name_err').hide();
        }

        if(collection_order == ""){
            valid = false;
            $('.collection_order_err').show();
        }else{
            $('.collection_order_err').hide();
        }

        if(num_of_images == 0){
            valid = false;
            $('.collection_image_err').show();
        }else{
            $('.collection_image_err').hide();
        }

        if(valid == true){
            const theForm = $('#submitForm');
            theForm.submit();
        }
    });
});



</script>

@endpush