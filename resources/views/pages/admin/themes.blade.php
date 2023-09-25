@extends('layouts.admin')
@section('content')

<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="javascript:void(0);" class="primary-btn add_theme_btn"><i class="bx bxs-plus-circle"></i> Add Theme </a>
            </div>
        </div>
    </div>
</section>

<div class="body">
    <div class="card">
        <div class="card-body">
            @if (\Session::has('errmsg'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('errmsg') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('successmsg'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('successmsg') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> All Themes</h1>
                </div>
            </div>

            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                <table class="display responsive nowrap w-100 Queries">
                    <thead>
                        <tr>
                            <th>Theme Name</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_themes as $theme)
                        <tr>
                            <td> <span class="pr-title">{{$theme->theme_name}}</span> </td>
                            <td class="">
                                <div class="btn-group dropstart">
                                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu svg-icon">
                                        <li> <a href="javascript:void(0);" class="edit_theme" theme_id="{{$theme->id}}"> Edit  </a> </li>
                                        <!-- <li> <a onclick="return confirm('Are you sure to delete?')" href="{{ route('delete_theme', [$theme->id]) }}" theme_id="{{$theme->id}}"> Delete  </a> </li> -->
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="questions" > 
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center title-area">
                    <h1 class="theme-title"></h1>
                </div>
                <form id="submitForm" method="POST" action="{{ route('save_theme') }}">
                @csrf
                    <div class="form-group">
                        <label class="label">Theme Name</label>
                        <input type="text" class="form-control theme_name" placeholder="Ex: Color, Size etc." value="" name="theme_name">
                    </div>
                    <div class="form-group">
                        <label class="label">Theme Details</label>
                        <textarea class="form-control theme_description" name="theme_description" rows="3" placeholder="Description goes here"></textarea>
                    </div>
                    <div class="d-flex">
                        <button class="outline-btn me-3 hide_modal">Cancel</button>
                        <button type="button" class="secondary-btn primary-btn submit_theme_item">Submit</button>
                        <input type="hidden" name="theme_id" class="theme_id">
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

 $(document).on("click",".add_theme_btn",function() {
    $('.theme_name').val('');
    $('.theme_description').val('');
    $('.theme_id').val('');
    $('.theme-title').text('Add Theme');
    $('#questions').modal('show');
 });



 $(document).on("click",".hide_modal",function(e) {
    e.preventDefault();
    $('#questions').modal('hide');
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
    return fetch("{{ route('fetch_theme_record') }}", requestOptions)
    .then(response => {
        return response.json()
    })
    .catch(error => {
        return error
    });
}

$(document).on("click",".edit_theme",function(e) {
    e.preventDefault();
    var theme_id = $(this).attr('theme_id');
    fetchOption({id:theme_id}).then(res=>{
        $('.theme-title').text('Edit Theme');
        var theme_details = res.theme_details;
        $('.theme_name').val(theme_details.theme_name);
        $('.theme_description').val(theme_details.theme_description);
        $('.theme_id').val(theme_details.id);
        $('#questions').modal('show');
    });
 });

 $(document).on("click",".submit_theme_item",function() {
    var valid = true;
    var theme_name = $('.theme_name').val();

    if(theme_name == ""){
        valid = false;
        $('.theme_name').css('border-color', 'red');
    }else{
        $('.theme_name').css('border-color', '');
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
 });
</script>
@endpush