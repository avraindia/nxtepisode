@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Edit Collection Item</h1>
                </div>
            </div>
            <form method="post" id="submitForm" action="{{ route('update_collection_item') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Collection Item name</label>
                                    <input type="text" class="form-control collection_name" placeholder="Ex: FIRST100" value="{{$collection_item->item_name}}" name="collection_name" required>
                                    <label class="input-error collection_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <input type="hidden" name="collection_item_id" value="{{$collection_item->id}}">
                            <input type="hidden" name="section_id" value="{{$collection_item->section_id}}">
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
                                            <input type="text" class="form-control collection_order" placeholder="" value="{{$collection_item->item_order}}" name="collection_order" required>
                                            <label class="input-error collection_order_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                        <a href="{{$collection_item->section_image_link}}" data-lightbox="photos"><img class="img-fluid" src="{{$collection_item->section_image_link}}" style="width: 300px;"></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script type="text/javascript">

$(function() {
    $('.input-error').hide();
    $(document).on("click",".save_collection_btn",function() {
        var valid = true;
        var collection_name = $('.collection_name').val();
        var collection_order = $('.collection_order').val();
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

        if(valid == true){
            const theForm = $('#submitForm');
            theForm.submit();
        }
    });
});



</script>

@endpush