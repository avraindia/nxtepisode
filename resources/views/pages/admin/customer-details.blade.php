@extends('layouts.admin')

@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Customer Details</h1>
                </div>
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
            </div>
            
            <form method="post" id="submitForm" action="{{ route('update_user') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Name</label>
                                    <input type="text" class="form-control user_name" placeholder="Ex: User Name" value="{{$user_details->full_name}}" name="user_name" disabled required>
                                    <label class="input-error user_name_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                    <input type="hidden" name="user_id" class="user_id" value="{{$user_details->user_id}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Email</label>
                                    <input type="text" class="form-control user_email" placeholder="Ex: email@gmail.com" value="{{$user_details->email}}" name="user_email" disabled required>
                                    <label class="input-error user_email_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">User Phone</label>
                                    <input type="text" class="form-control user_phone" placeholder="Ex: 1234567890" value="{{$user_details->phone_number}}" name="user_phone" disabled required>
                                    <label class="input-error user_phone_err"><img src="{{ asset('backend/images/icon/icon-error.svg') }}" alt=""> This field cannot be empty</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio1" value="m" @if($user_details->gender=="m") checked @endif disabled>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_gender" id="inlineRadio2" value="f" @if($user_details->gender=="f") checked @endif disabled>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
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
        
    </div>
</div> 
@stop
@push('scripts')
<script type="text/javascript">
$(function() {
    $('.input-error').hide();

});

</script>
@endpush