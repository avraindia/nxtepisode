@extends('layouts.admin')

@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Change User</h1>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="post" id="submitForm" action="{{ route('update_user') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-7 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="oldPasswordInput" class="form-label">New Email</label>
                                    <input name="new_email" type="text" class="form-control" id="new_email" placeholder="Email">
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
        <button type="button" class="btn-theme-blue save_user_btn">Save</button>
    </div>
</div> 
@stop

@push('scripts')
<script>
$(document).on("click",".save_user_btn",function() {
    var new_email = $('#new_email').val();
    if(!isEmail(new_email)){
        $('#new_email').css('border-color', 'red');
        return false;
    }else{
        $('#new_email').css('border-color', '');
    }
    const theForm = $('#submitForm');
    theForm.submit();
});
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
@endpush