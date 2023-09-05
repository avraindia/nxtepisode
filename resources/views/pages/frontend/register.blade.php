<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #00000038;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
<link rel="stylesheet" href="{{ asset('backend/libs/datatables/jquery-ui.css') }}">
</head>
<body>

<form id="submitForm" method="post">
@csrf
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="email"><b>First Name</b></label>
    <input type="text" placeholder="First Name" name="first_name" id="first_name" value="">

    <label for="email"><b>Last Name</b></label>
    <input type="text" placeholder="Last Name" name="last_name" id="last_name" value="">

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="user_email" id="user_email" value="">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw">

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw_repeat" id="psw_repeat">

    <label for="email"><b>Phone</b></label>
    <input type="text" placeholder="Enter Phone" name="user_phone" id="user_phone" value="">

    <label for="email"><b>Gender</b></label>
    <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio1" value="m" checked> Male
    <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio2" value="f"> Female

    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="button" class="registerbtn">Register</button>
  </div>

  <div class="resp"></div>
  
  <div class="container signin">
    <p>Already have an account? <a href="{{route('frontlogin')}}">Sign in</a>.</p>
  </div>
</form>
<script src="{{ asset('backend/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>
</html>

<script type="text/javascript">
$(document).on("click",".registerbtn",function() {
    if(validate_form() == true){
        var _token = $('meta[name="csrf-token"]').attr('content');
        var form = $('#submitForm')[0];
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
                    $('.resp').html(data.msg);
                }else{
                    $('.resp').html(data.msg);
                    $("#submitForm")[0].reset();	
                }
            }

        }); 
    }
});

function validate_form(){
    var valid = true;
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var user_email = $('#user_email').val();
    var psw = $('#psw').val();
    var psw_repeat = $('#psw_repeat').val();
    var user_phone = $('#user_phone').val();

    if(first_name == ""){
        valid = false;
        $('#first_name').css('border-color', 'red');
    }else{
        $('#first_name').css('border-color', '');
    }

    if(last_name == ""){
        valid = false;
        $('#last_name').css('border-color', 'red');
    }else{
        $('#last_name').css('border-color', '');
    }

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
        if(psw_repeat != psw){
            valid = false;
            $('#psw_repeat').css('border-color', 'red');
        }else{
            $('#psw_repeat').css('border-color', '');
        }
        $('#psw').css('border-color', '');
    }
    return valid;
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>