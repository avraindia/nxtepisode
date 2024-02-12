@extends('layouts.admin')
@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            @if (\Session::has('successmsg'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('successmsg') !!}</li>
                    </ul>
                </div>
            @endif
            <form method="post" id="submitForm" action="{{ route('save_settings') }}" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label class="label">Shipping Fee Inside West Bengal</label>
                            <input type="text" class="form-control shipping_fee_inside_west_bengal" value="{{ $shipping_fee_inside_west_bengal }}" name="shipping_fee_inside_west_bengal" required>
                            <label class="input-error shipping_fee_inside_west_bengal_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label class="label">Shipping Fee Outside West Bengal</label>
                            <input type="text" class="form-control shipping_fee_outside_west_bengal" value="{{ $shipping_fee_outside_west_bengal }}" name="shipping_fee_outside_west_bengal" required>
                            <label class="input-error shipping_fee_outside_west_bengal_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label class="label">Global GST (in %)</label>
                            <input type="text" class="form-control global_gst" value="{{ $global_gst }}" name="global_gst" required>
                            <label class="input-error global_gst_error"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
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
        <button type="button" class="btn-theme-blue save_site_settings_button">Save</button>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
$(function() {
    $('.input-error').hide();
});

$(document).on('click', '.save_site_settings_button', function(e) {
    var valid = true;
    var shipping_fee_inside_west_bengal = $('.shipping_fee_inside_west_bengal').val();
    var shipping_fee_outside_west_bengal = $('.shipping_fee_outside_west_bengal').val();
    var global_gst = $('.global_gst').val();

    if(shipping_fee_inside_west_bengal==""){
        valid = false;
        $('.shipping_fee_inside_west_bengal').css('border-color', 'red');
    }else{
        $('.shipping_fee_inside_west_bengal').css('border-color', '');
    }

    if(shipping_fee_outside_west_bengal==""){
        valid = false;
        $('.shipping_fee_outside_west_bengal').css('border-color', 'red');
    }else{
        $('.shipping_fee_outside_west_bengal').css('border-color', '');
    }

    if(global_gst==""){
        valid = false;
        $('.global_gst').css('border-color', 'red');
    }else{
        $('.global_gst').css('border-color', '');
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});
</script>
@endpush