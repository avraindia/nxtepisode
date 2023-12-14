@extends('layouts.front')
@section('content')

<!-- <-----------------Banner section start--------------->
<section class="home-page-main-banner all-section-banner">
    <div class="main-banner-image">
        <img src="{{ asset('frontend/images/home-page-banner.jpg') }}" alt="">
    </div>
    <div class="home-page-banner-inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="main-banner-text">
                        <h1 class="wow fadeInUp" data-wow-duration="1500ms">Edit Profile</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <-----------------Banner section End--------------->
<!-- <----------------- section start--------------->
<section class="delivery-to-address-section my-order-section">
    <div class="container">
        <div class="row">
            @include('pages.frontend.user-sidebar-child') 
            <div class="col-lg-9 col-md-12">
                <div class="confirm-order-payment-option-header-text">
                    <h5>EDIT PROFILE</h5>
                </div>
                @if(session()->has('successmsg'))
                    <div class="alert alert-success">{{session()->get('successmsg')}}</div>
                @endif
                <div class="general-information-profile-section">
                    <form method="post" id="submitForm" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="profile-page-email-section">
                            <div class="col-md-7">
                                <div class="new-address-form-input">
                                    <label>Email ID</label>
                                    <input type="text" placeholder="Email" class="email_address" name="email_address" value="{{$user_details->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="general-information-profile-form-section">
                            <div class="general-information-profile-top-text">
                                <h5>General Information</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="new-address-form-input">
                                        <label>Name</label>
                                        <input type="text" placeholder="Name" class="full_name" name="full_name" value="{{$user_details->full_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="new-address-form-input">
                                        <label>Phone No.</label>
                                        <input type="text" placeholder="Phone No." class="phone_number" name="phone_number" value="{{$user_details->phone_number}}">
                                        <input type="hidden" name="user_id" class="user_id" value="{{$user->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edit-profile-picture">
                            <div class="general-information-profile-top-text">
                                <h5>Edit Profile Picture</h5>
                            </div>
                            <div class="row g-lg-4 g-3">
                                <div class="col-md-3">
                                    <div class="profile-image">
                                        <img src="{{$user_details->profile_image_link}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="upload-image-delete-btn-section">
                                        <div class="upload-image-section">
                                            <div class="upload-image-icon">
                                                <img class="img-fluid" src="assets/images/upload-image-icon.png" alt="">
                                            </div>
                                            <div class="upload-image-text">
                                                <h6>Upload Profile Image Here</h6>
                                                <p>Supported formats are JPG, PNG and WebP</p>
                                            </div>
                                            <div class="upload-image-select-btn">
                                                <div class="new-address-form-input">
                                                    <input type="file" name="user_image" id="file-input" class="file-input__input">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-save-btn">
                            <input type="button" class="save_user_btn" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <----------------- section End--------------->
@stop

@push('scripts')
<script>
$(document).on("click",".save_user_btn",function() {
    var valid = true;
    var email_address = $('.email_address').val();
    var full_name = $('.full_name').val();
    var phone_number = $('.phone_number').val();
    var user_id = $('.user_id').val();

    if(!isEmail(email_address)){
        $('.email_address').css('border-color', 'red');
        valid = false;
    }else{
        $('.email_address').css('border-color', '');
    }

    if(full_name == ""){
        $('.full_name').css('border-color', 'red');
        valid = false;
    }else{
        $('.full_name').css('border-color', '');
    }

    if(phone_number == ""){
        $('.phone_number').css('border-color', 'red');
        valid = false;
    }else{
        $('.phone_number').css('border-color', '');
    }

    if(valid == false){
        return false;
    }

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('check_email') }}",
        method: 'POST',
        data: {_token: _token, email_address:email_address, user_id:user_id},
        success: function (data) { 
            if(data.resp == true){
                const theForm = $('#submitForm');
                theForm.submit();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: data.msg,
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                });
            }
        }
    }); 
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
@endpush