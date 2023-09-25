@extends('layouts.admin')
@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Option Value</h1>
                </div>
                <a href="{{ route('options') }}" class="btn btn-success">Back</a>
            </div>
            <form method="post" id="submitForm" action="{{ route('save_option_value') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="label">Option Name: </label>{{$option_details->option_name}}
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="label">Option Value</label>
                                    <input type="text" class="form-control option_value" placeholder="Ex: FIRST100" value="" name="option_value">
                                    <input type="hidden" name="option_id" class="option_id" value="{{$option_details->id}}" >
                                    <input type="hidden" name="option_value_id" class="option_value_id" value="" >
                                    <label class="input-error option_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <div class="form-group">
                                    @foreach($all_option_values as $option_value)
                                    <div class="list-container">
                                        <div class="align-items-center content g-3 row">
                                            <div class="col-lg-9 col-md-9 text-md-start text-center">
                                                <span>{{$option_value->option_value}} </span>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <a href="javascript:void(0);" class="btn-theme-blue edit_value mb-2 flex-lg-row" value_id="{{$option_value->id}}"><i class="fa-light fa-pen-to-square me-2"></i> EDIT</a>
                                                <a href="javascript:void(0);" class="btn-theme-blue delete_value flex-lg-row" value_id="{{$option_value->id}}"><i class="fa-light fa-trash me-2"></i> DELETE</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
        <button type="button" class="btn-theme-blue save_option_value_btn">Save</button>
    </div>
</div>    
@stop

@push('scripts')
<script type="text/javascript">
$('.input-error').hide();

$(document).on("click",".save_option_value_btn",function() {
    var valid = true;
    var option_value = $('.option_value').val();
    $('.option_err').hide();
    if(option_value == ""){
        valid = false;
        $('.option_err').show();
    }else{
        $('.option_err').hide();
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});

$(document).on("click",".edit_value",function(e) {
    var value_id = $(this).attr('value_id');
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('fetch_option_value') }}",
        method: 'POST',
        data: {_token: _token, id:value_id},
        success: function (data) { 
            $('.option_value_id').val(data.id);
            $('.option_value').val(data.option_value);
        }
    }); 
});

$(document).on("click",".delete_value",function(e) {
    if (confirm("Are you sure to delete?") == true) {
        var value_id = $(this).attr('value_id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('delete_option_value') }}",
            method: 'POST',
            data: {_token: _token, id:value_id},
            success: function (data) { 
                if(data.status == 0){
                    alert(data.msg)
                }else{
                    location.reload();
                }
            }
        }); 
    }
});
</script>
@endpush