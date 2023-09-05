@extends('layouts.admin')

@section('content')
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Service Name : </label>
                                <h6>{{$service_details->name}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Service Description : </label>
                                <h6>{{$service_details->description}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Service Location : </label>
                                <h6>{{$service_details->location}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Hashtags : </label>
                                <h6>{{$service_details->tags}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="label">Average Rating : </label>
                                <h6>{{$service_details->average_rating}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <div class="row">
                        @foreach($service_details->meta as $service_meta)

                            @if($service_meta->meta_key =='contact_number')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Contact Number : </label>
                                    <h6>{{$service_meta->meta_value}}</h6>
                                </div>
                            </div>
                            @endif

                            @if($service_meta->meta_key =='whatsapp_number')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Whatsapp Number : </label>
                                    <h6>{{$service_meta->meta_value}}</h6>
                                </div>
                            </div>
                            @endif

                            @if($service_meta->meta_key =='email')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Email : </label>
                                    <h6>{{$service_meta->meta_value}}</h6>
                                </div>
                            </div>
                            @endif

                            @if($service_meta->meta_key =='site')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Site Url : </label>
                                    <h6>{{$service_meta->meta_value}}</h6>
                                </div>
                            </div>
                            @endif

                            @if($service_meta->meta_key =='playstore_link')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Playstore Link : </label>
                                    <h6>{{$service_meta->meta_value}}</h6>
                                </div>
                            </div>
                            @endif

                            @if($service_meta->meta_key =='applestore_link')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label">Applestore Link : </label>
                                    <h6>{{$service_meta->meta_value}}</h6>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <div class="row">
                        <label class="label">Service List : </label>
                        <ul>
                        @foreach($service_details->service_list as $service_list)
                            <li>{{$service_list->name}}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <div class="row">
                        <label class="label">Service Images : </label>
                        @foreach($service_details->images as $service_image)
                            <div class="col-lg-3">
                                <div class="variation-gal-img-container">
                                    <img src="{{$service_image->service_image_link}}" alt="Snow">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@push('scripts')

<script>
</script>

@endpush