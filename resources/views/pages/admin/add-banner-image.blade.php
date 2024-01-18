@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
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
                    <h1 class="card-title m-md-0 mb-3"> Add Slider Image</h1>
                </div>
            </div>
            <form id="submitForm" action="{{route('save_banner_image')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="label">Slider Image</label>
                                <input type="file" class="form-control banner_image" name="banner_image[]" multiple>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="label"></label>
                                <button type="button" class="btn-theme-blue save_image_btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="banner_type" class="banner_type" value="{{$type}}">
            </form>
        </div>
        <div class="lightbox-gallery">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">Slider Images</h2>
                </div>
                <div class="row photos">
                    @foreach($banner_images as $image)
                    <div class="col-sm-6 col-md-4 col-lg-3 item">
                        <a href="{{$image->homepage_banner_link}}" data-lightbox="photos"><img class="img-fluid" src="{{$image->homepage_banner_link}}"></a>
                        <a class="alert alert-danger" onclick="return confirm('Are you sure to delete?')" href="{{route('delete_banner_image', $image->id)}}">X</a>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script type="text/javascript">
$(document).on("click",".save_image_btn",function(e) {
    e.preventDefault();
    var num_of_images = $(".banner_image")[0].files.length;
    if(num_of_images > 0){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});

</script>
@endpush