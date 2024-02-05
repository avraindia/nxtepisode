@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> Add Images for {{$section_details->section_name}}</h1>
                </div>
            </div>
            <form id="submitForm" action="{{route('save_section_image')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="label">Section Image</label>
                                <input type="file" class="form-control section_image" name="section_image[]" multiple>
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
            <input type="hidden" name="section_id" class="section_id" value="{{$section_details->id}}">
            </form>
        </div>
        <div class="lightbox-gallery">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">Image Gallery</h2>
                </div>
                <div class="row photos">
                    @foreach($image_gallery as $image)
                    <div class="col-sm-6 col-md-4 col-lg-3 item">
                        <a href="{{$image->section_image_link}}" data-lightbox="photos"><img class="img-fluid" src="{{$image->section_image_link}}"></a>
                        <button class="alert alert-danger delete_collection_image" image_id="{{$image->id}}">Delete</button>
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
    var num_of_images = $(".section_image")[0].files.length;
    if(num_of_images > 0){
        const theForm = $('#submitForm');
        theForm.submit();
    }
});

$(document).on("click",".delete_collection_image",function(e) {
    if (confirm("Do you want to delete the image?") == true) {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var image_id = $(this).attr('image_id');
        $.ajax({
            url: "{{ route('delete_collection_image') }}",
            method: 'POST',
            data: {_token: _token, image_id:image_id},
            success: function (data) { 
                if(data.status == true){
                    location.reload();
                }
            }
        });
    }
});

</script>
@endpush