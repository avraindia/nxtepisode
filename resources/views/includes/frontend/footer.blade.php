<script type="text/javascript" src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/custom.js?v=1') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">

<script type="text/javascript">
$(document).on("click",".loginbtn",function() {
    if(validate_login_form() == true){
        var _token = $('meta[name="csrf-token"]').attr('content');
        var form = $('#submitLoginForm')[0];
        var formdata = new FormData(form);
        formdata.append('_token', _token);
        
        $.ajax({
            url: "{{ route('submit_login_form') }}",
            method: 'POST',
            processData: false,
            contentType: false,
            data: formdata,
            success: function (data) { 
                if(data.resp == '0'){
                    $('.login_resp').addClass('alert-danger').removeClass('alert-success').html(data.msg);
                }else{
                    $('.login_resp').removeClass('alert-danger').addClass('alert-success').html(data.msg);
                    
                    setTimeout(function () {
                      location.reload();
                    }, 2500);
                }
            }

        }); 
    }
});

$(document).on("click",".registerbtn",function() {
    if(validate_register_form() == true){
        var _token = $('meta[name="csrf-token"]').attr('content');
        var form = $('#submitRegisterForm')[0];
        var formdata = new FormData(form);
        formdata.append('_token', _token);
        
        $.ajax({
            url: "{{ route('submit_register_form') }}",
            method: 'POST',
            processData: false,
            contentType: false,
            data: formdata,
            success: function (data) { 
                if(data.resp == '0'){
                    $('.register_resp').addClass('alert-danger').removeClass('alert-success').html(data.msg);
                }else{
                    $('.register_resp').removeClass('alert-danger').addClass('alert-success').html(data.msg);
                    $("#submitRegisterForm")[0].reset();
                    setTimeout(function () {
                        switchCard();
                    }, 2000);	
                }
            }

        }); 
    }
});

function validate_login_form(){
    var valid = true;
    var user_email = $('#user_email').val();
    var psw = $('#psw').val();

    if(!isEmail(user_email)){
        $('#user_email').css('border-color', 'red');
        valid = false;
    }else{
        $('#user_email').css('border-color', '');
    }

    if(psw == ""){
        valid = false;
        $('#psw').css('border-color', 'red');
    }else{
        $('#psw').css('border-color', '');
    }
    return valid;
}

function validate_register_form(){
    var valid = true;
    var full_name = $('#full_name').val();
    var reg_email = $('#reg_email').val();
    var new_password = $('#new_password').val();
    var psw_repeat = $('#psw_repeat').val();
    var user_phone = $('#user_phone').val();

    if(full_name == ""){
        valid = false;
        $('#full_name').css('border-color', 'red');
    }else{
        $('#full_name').css('border-color', '');
    }

    if(!isEmail(reg_email)){
        $('#reg_email').css('border-color', 'red');
        valid = false;
    }else{
        $('#reg_email').css('border-color', '');
    }

    if(new_password == ""){
        valid = false;
        $('#new_password').css('border-color', 'red');
    }else{
        if(psw_repeat != new_password){
            valid = false;
            $('#psw_repeat').css('border-color', 'red');
        }else{
            $('#psw_repeat').css('border-color', '');
        }
        $('#new_password').css('border-color', '');
    }
    return valid;
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>