@extends('layouts.admin')

@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Edit User</h1>
                </div>
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
            </div>
            <!--- 
            Permissions:
            1. Show Left Menu
                a. show_dashboard_menu
                b. show_user_menu
                c. show_product_menu

            2. Action Permission
                a. add_product
                b. view_product
                c. edit_product
                d. delete_product
            -->
            <form method="post" id="submitForm" action="{{ route('update_user') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Name</label>
                                    <input type="text" class="form-control user_name" placeholder="Ex: User Name" value="{{$user_details->full_name}}" name="user_name" required>
                                    <label class="input-error user_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                    <input type="hidden" name="user_id" class="user_id" value="{{$user_details->user_id}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Email</label>
                                    <input type="text" class="form-control user_email" placeholder="Ex: email@gmail.com" value="{{$user_details->email}}" name="user_email" required>
                                    <label class="input-error user_email_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Password</label>
                                    <input type="password" class="form-control user_password" placeholder="Ex: password" value="" name="user_password" required>
                                    <label class="input-error user_password_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Activate User</label>
                                        <input type="checkbox" class="switch" name="is_active"  @if($user->is_active == 1) checked  @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Phone</label>
                                    <input type="text" class="form-control user_phone" placeholder="Ex: 1234567890" value="{{$user_details->phone_number}}" name="user_phone" required>
                                    <label class="input-error user_phone_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio1" value="m" @if($user_details->gender=="m") checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio2" value="f" @if($user_details->gender=="f") checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <h1 class="card-title m-md-0 mb-3">Permission</h1>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Show Dashboard Menu</label>
                                        <input type="checkbox" class="switch user_permission" value="show_dashboard_menu" name="user_permission[]" @if(in_array('show_dashboard_menu', $permissions)) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Show User Menu</label>
                                        <input type="checkbox" class="switch user_permission" value="show_user_menu" name="user_permission[]" @if(in_array('show_user_menu', $permissions)) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Show Product Menu</label>
                                        <input type="checkbox" class="switch user_permission" value="show_product_menu" name="user_permission[]" @if(in_array('show_product_menu', $permissions)) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Add Product</label>
                                        <input type="checkbox" class="switch user_permission" value="add_product" name="user_permission[]" @if(in_array('add_product', $permissions)) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>View Product</label>
                                        <input type="checkbox" class="switch user_permission" value="view_product" name="user_permission[]" @if(in_array('view_product', $permissions)) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Edit Product</label>
                                        <input type="checkbox" class="switch user_permission" value="edit_product" name="user_permission[]" @if(in_array('edit_product', $permissions)) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <label class="label"></label>
                                    <div class="switch_box">
                                        <label>Delete Product</label>
                                        <input type="checkbox" class="switch user_permission" value="delete_product" name="user_permission[]" @if(in_array('delete_product', $permissions)) checked @endif>
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
        <button class="btn-theme-blue me-3 back_btn">Cancel</button>
        <button type="button" class="btn-theme-blue save_user_btn">Save</button>
    </div>
</div> 
@stop
@push('scripts')
<script type="text/javascript">
$(function() {
    $('.input-error').hide();

});

$(document).on("click",".save_user_btn",function() {
    var valid = true;
    var user_name = $('.user_name').val();
    var user_email = $('.user_email').val();

    if(user_name == ""){
        valid = false;
        $('.user_name_err').show();
    }else{
        $('.user_name_err').hide();
    }

    if(!isEmail(user_email)){
        $('.user_email').css('border-color', 'red');
        valid = false;
    }else{
        $('.user_email').css('border-color', '');
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }

});

$(document).on("change",".user_permission",function() {
    if ($(this).prop('checked')==true){ 
        var is_check = "yes";
    }else{
        var is_check = "no";
    }
    var user_id = $('.user_id').val();
    var permission_name = $(this).val();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('change_user_permission') }}",
        method: 'POST',
        data: {_token: _token, is_check:is_check, user_id:user_id, permission_name:permission_name},
        success: function (data) { 
            console.log(data);
        }

    }); 
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
@endpush