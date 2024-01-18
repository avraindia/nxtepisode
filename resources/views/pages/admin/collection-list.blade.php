@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<!-- ======================= Border Start Topbar ================== -->
<section class="mt-4">
    <div class="container">
        <div class="row">
            <div class="offset-lg-9 col-lg-3 col-sm-12">
                <a href="{{ route('add_collection', $section_details->id) }}" class="primary-btn"><i class="bx bxs-plus-circle"></i> Add Collection </a>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Border End Topbar ================== -->

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
                    <h1 class="card-title m-md-0 mb-3"> Collection Item List For {{$section_details->section_name}}</h1>
                </div>
            </div>
            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                <table class="display responsive nowrap w-100 Queries">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Order</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collection_items as $collection_item)
                        <tr>
                            <td>
                                <span class="pr-title">
                                    {{$collection_item->item_name}}
                                </span>
                            </td>
                            <td>
                            <a href="{{$collection_item->section_image_link}}" data-lightbox="photos"><img class="img-fluid" src="{{$collection_item->section_image_link}}" style="width: 150px;"></a>
                            </td>
                            <td>
                                <span class="pr-title">
                                    {{$collection_item->item_order}}
                                </span>
                            </td>
                            <td class="">
                                <div class="btn-group dropstart">
                                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu svg-icon">
                                        <li> <a href="{{route('edit_collection', $collection_item->id)}}">Edit  </a> </li>
                                        <li> <a href="{{route('collection_product', $collection_item->id)}}">Add Product  </a> </li>
                                        <li> <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_collection_item', $collection_item->id)}}">Delete</a> </li>
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

</script>
@endpush