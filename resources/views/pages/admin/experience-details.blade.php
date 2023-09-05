@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Experience Name : </label>
                                <h6>{{$experience_details->title}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Experience Description : </label>
                                <h6>{{$experience_details->description}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Experience Location : </label>
                                <h6>{{$experience_details->location}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Hashtags : </label>
                                <h6>{{$experience_details->tags}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Rating : </label>
                                <h6>{{$experience_details->rating}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12">
                    <div class="row">
                        <label class="label">Experience Images : </label>
                        @foreach($experience_details->images as $experience_image)
                            <div class="col-lg-2">
                                <div class="variation-gal-img-container">
                                    <a href="{{$experience_image->experience_image_link}}" data-fancybox="gallery" >
                                        <img src="{{$experience_image->experience_image_link}}" alt="Snow">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    @if($experience_details->is_block =='0')
                        <a href="javascript:void(0);" class="btn btn-danger block-experience-btn" action="block" id_experience={{$experience_details->id}}>Block</a>
                    @endif
                    @if($experience_details->is_block =='1') 
                        <a href="javascript:void(0);" class="btn btn-success block-experience-btn" action="unblock" id_experience={{$experience_details->id}}>Unblock</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("[data-fancybox]").fancybox();
    $(document).on("click",".block-experience-btn",function() {
        var _token = $('meta[name="csrf-token"]').attr('content');
        var id_experience = $(this).attr('id_experience');
        var action = $(this).attr('action');
        $.ajax({
            url: "{{ route('block_experience') }}",
            method: 'POST',
            data: {_token: _token, id_experience:id_experience, action:action},
            success: function (data) { 
                if(data.status == true){
                    location.reload();
                }
            }
        });
    });
</script>

@endpush