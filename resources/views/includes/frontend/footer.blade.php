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

const fetchOption = (options) => {
    var requestOptions = {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        body : JSON.stringify(options),
    };
    return fetch("{{ route('search_product_list') }}", requestOptions)
    .then(response => {
        return response.json()
    })
    .catch(error => {
        return error
    });
}
$('.suggestionList').hide();
function fetchSuggestion(event){
    var search_key = event.value;
    if(search_key != ""){
        fetchOption({search_key:search_key}).then(res=>{
            var data = res.data;
            $('.suggestionList').html('');
            for(var i=0; i<data.length; i++){
                var single_rec = data[i];
                var id = single_rec.id;
                var fitting_title = single_rec.fitting_title;
                var encoded_id = btoa(id);
                
                var html_body = '<li class="suggesion_item" value="'+encoded_id+'">'+fitting_title+'</li>';
                $('.suggestionList').append(html_body);
                $('.suggestionList').show();
            }
        });
    }else{
        $('.suggestionList').html('');
    }
    
}

$(document).on("click",".suggesion_item",function() {
    var product_id = $(this).attr('value');
    var url = '{{ route("front_product_details", ":id") }}';
    url = url.replace(':id', product_id);

    window.location.href = url;
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

function logoutFunction(){
    Swal.fire({
        icon: 'question',
        title: 'Do you want to logout?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Logout',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{route('frontlogout')}}";
        } 
    });
    return false;
}
</script>