@extends('layouts.admin')
@section('content')

<!-- ======================= Border Start Topbar ================== -->
<!-- <section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="javascript:void(0);" class="primary-btn add_option_btn"><i class="bx bxs-plus-circle"></i> Add Option </a>
            </div>
        </div>
    </div>
</section> -->

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
                    <h1 class="card-title m-md-0 mb-3"> All Options</h1>
                </div>
            </div>

            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                <table class="display responsive nowrap w-100 Queries">
                    <thead>
                        <tr>
                            <th>Option Name</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_options as $option)
                        <tr>
                            <td> <span class="pr-title">{{$option->option_name}}</span> </td>
                            <td class="">
                                <div class="btn-group dropstart">
                                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu svg-icon">
                                        <!-- <li> <a href="javascript:void(0);" class="edit_option" option_id="{{$option->id}}"> Edit  </a> </li> -->
                                        <li> <a href="{{ route('add_option_value', $option->id) }}"> Add Value  </a> </li>
                                        <!-- <li> <a onclick="return confirm('Are you sure to delete?')" href="{{ route('delete_option', [$option->id]) }}" variation_id="{{$option->id}}"> Delete  </a> </li> -->
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
                    <h1 class="product-title"></h1>
                </div>
                <form id="submitForm" method="POST" action="{{ route('save_option') }}">
                @csrf
                    <div class="form-group">
                        <label class="label">Option Name</label>
                        <input type="text" class="form-control option_name" placeholder="Ex: Color, Size etc." value="" name="option_name">
                    </div>
                    <div class="form-group">
                        <label class="label">Option Details</label>
                        <textarea class="form-control option_description" name="option_description" rows="3" placeholder="Description goes here"></textarea>
                    </div>
                    <div class="d-flex">
                        <button class="outline-btn me-3 hide_modal back_btn">Cancel</button>
                        <button type="button" class="secondary-btn primary-btn submit_option_item">Submit</button>
                        <input type="hidden" name="option_id" class="option_id">
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

 $(document).on("click",".add_option_btn",function() {
    $('.option_name').val('');
    $('.option_description').val('');
    $('.option_id').val('');
    $('.product-title').text('Add Option');
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
    return fetch("{{ route('fetch_option_record') }}", requestOptions)
    .then(response => {
        return response.json()
    })
    .catch(error => {
        return error
    });
}

$(document).on("click",".edit_option",function(e) {
    e.preventDefault();
    var option_id = $(this).attr('option_id');
    fetchOption({id:option_id}).then(res=>{
        $('.product-title').text('Edit Option');
        var option_details = res.option_details;
        $('.option_name').val(option_details.option_name);
        $('.option_description').val(option_details.option_description);
        $('.option_id').val(option_details.id);
        $('#questions').modal('show');
    });
 });

 $(document).on("click",".submit_option_item",function() {
    var valid = true;
    var option_name = $('.option_name').val();

    if(option_name == ""){
        valid = false;
        $('.option_name').css('border-color', 'red');
    }else{
        $('.option_name').css('border-color', '');
    }

    if(valid == true){
        const theForm = $('#submitForm');
        theForm.submit();
    }
 });
</script>
@endpush