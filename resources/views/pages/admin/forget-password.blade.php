<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Forget Password </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('backend/css/admin.style.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('backend/css/responsive.css?v=2') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
        <section class="register-bg-form">
        <div class="container">
            <div class="row">
            <div class="col-lg-6 col-sm-12 offset-lg-3">
              <div class="admin-logging-page-logo-image" style="text-align: center;  margin-bottom: 22px;">
                <img src="{{ asset('backend/images/logo.png') }}" class="img-fluid" alt="" style="width:120px;">
              </div>
                <div class="card card-white mt-0">
                    <div class="card-body">
                        <div class="row forget_password_form">
                            <div class="col-lg-12 col-sm-12">
                            <h2 class="reg-title">Put Your Email Here</h2>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3 form-box form-group">
                                        <img src="{{ asset('backend/images/f-icon-mail.svg') }}" alt="" class="form-icon">
                                        <input type="email" name="old_email" class="form-control cus-form-control" id="old_email" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3">
                                            <button class="btn-green-arrow btn-fil-color submit_forget_email_submit_btn"><span> Submit </span></button>
                                            <span class="text-danger email_error"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row otp_submission_form" style="display:none;">
                            <div class="col-lg-12 col-sm-12">
                            <h2 class="reg-title">Put OTP Here.</h2>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3 form-box form-group">
                                        <label for="email" class="control-label">An OTP has been send to your Email. Please put OTP here.</label><i class="bar"></i>
                                        <img src="{{ asset('backend/images/f-icon-mail.svg') }}" alt="" class="form-icon">
                                        <input type="text" name="otp" class="form-control cus-form-control" id="otp" placeholder="" autocomplete="off">
                                        <input type="hidden" name="check_otp" id="check_otp" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3">
                                            <button class="btn-green-arrow btn-fil-color submit_otp_submit_btn"><span> Submit </span></button>
                                            <span class="text-danger otp_error"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row password_submission_form" style="display:none;">
                            <div class="col-lg-12 col-sm-12">
                            <h2 class="reg-title">Password Change</h2>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3 form-box form-group">
                                        <label for="email" class="control-label">New Password</label><i class="bar"></i>
                                        <img src="{{ asset('backend/images/f-icon-mail.svg') }}" alt="" class="form-icon">
                                        <input type="password" name="new_password" class="form-control cus-form-control" id="new_password" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3 form-box form-group">
                                        <label for="email" class="control-label">Confirm Password</label><i class="bar"></i>
                                        <img src="{{ asset('backend/images/f-icon-mail.svg') }}" alt="" class="form-icon">
                                        <input type="password" name="confirm_password" class="form-control cus-form-control" id="confirm_password" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" class="user_id" value="">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="mb-3">
                                            <button class="btn-green-arrow btn-fil-color submit_password_submit_btn"><span> Submit </span></button>
                                            <span class="text-danger password_error"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row back_login_form" style="display:none;">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                        <h2 class="reg-title">Password changed successfully.</h2>
                            <img src ="{{ asset('backend/images/check-mark-verified.gif') }}">
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <a href="{{ route('signin') }}"><button class="btn btn-success"><span> Back to Login </span></button></a>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
      </section>
</body>
</html>
<script src="{{ asset('backend/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$('.otp_submission_form').hide();
$('.password_submission_form').hide();
$('.back_login_form').hide();
$(document).on('click', '.submit_forget_email_submit_btn', function(){
    var old_email = $('#old_email').val();
    $('.email_error').html('');
    if(!isEmail(old_email)){
        $('#old_email').css('border-color', 'red');
        return false;
    }else{
        $('#old_email').css('border-color', '');
    }
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('send_forget_password_email') }}",
        method: 'POST',
        data: {_token: _token, old_email:old_email},
        success: function (data) { 
            if(data.resp == '0'){
                $('.email_error').html(data.msg);
            }else{
                $('.forget_password_form').hide();
                $('.password_submission_form').hide();
                $('.otp_submission_form').show();
                $('.email_error').html('');
                $('.otp_submission_form').show();
                $('#check_otp').val(data.otp);
                $('.user_id').val(data.user_id);
            }
        }
    }); 
});

$(document).on('click', '.submit_otp_submit_btn', function(){
    $('.otp_error').html('');
    var otp = $('#otp').val();
    var check_otp = $('#check_otp').val();
    if(otp == ""){
        $('#otp').css('border-color', 'red');
        return false;
    }else{
        $('#otp').css('border-color', '');
    }

    if(otp != check_otp){
        $('.otp_error').html('OTP does not match. Try again.');
    }else{
        $('.otp_error').html('');
        $('.forget_password_form').hide();
        $('.password_submission_form').show();
        $('.otp_submission_form').hide();
    }
});

$(document).on('click', '.submit_password_submit_btn', function(){
    var new_password = $('#new_password').val();
    var confirm_password = $('#confirm_password').val();
    var user_id = $('.user_id').val();
    $('.password_error').html('');

    var valid = true;
    if(new_password == "" ){
        $('#new_password').css('border-color', 'red');
        valid = false;
    }else{
        $('#new_password').css('border-color', '');
    }

    if(confirm_password == "" ){
        $('#confirm_password').css('border-color', 'red');
        valid = false;
    }else{
        if(new_password != confirm_password ){
            $('.password_error').html('Password does not match.');
            valid = false;
        }else{
            $('.password_error').html('');
        }
    }

    if(valid == false){
        return false;
    }

    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{ route('modify_password') }}",
        method: 'POST',
        data: {_token: _token, password:new_password, user_id:user_id},
        success: function (data) { 
            if(data.resp == '1'){
                $('.password_submission_form').hide();
                $('.card-white').hide();
                $('.back_login_form').show();
            }
        }
    }); 
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>