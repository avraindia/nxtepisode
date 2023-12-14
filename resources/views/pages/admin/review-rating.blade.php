@extends('layouts.admin')
@section('content')

<!-- ======================= Border End Topbar ================== -->
<div class="body">
    <div class="card">
        <div class="card-body">
            <div class="align-items-center d-md-flex justify-content-between mb-4">
                <div class="">
                    <h1 class="card-title m-md-0 mb-3"> All Reviews</h1>
                </div>
            </div>

            <div id="all-orders" class="table-responsive-sm position-relative withdra-tab-content active">
                <table class="display coustom-table nowrap w-100 Queries">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rating_review as $review)
                        <tr class="table-body-tr">
                            <td>
                                <span class="pr-title">
                                    {{$review->name}}
                                </span>
                            </td>
                            <td>
                                <span class="pr-title">
                                    {{$review->email}}
                                </span>
                            </td>
                            <td>
                                <span class="pr-title">
                                    {{$review->rating}}
                                </span>
                            </td>
                            <td>
                                <span class="pr-title">
                                    {{$review->review}}
                                </span>
                            </td>
                            <td>
                                <span class="pr-title">
                                    <div class="switch_box">
                                        <input type="checkbox" class="switch" name="is_available" @if($review->status == 1) checked  @endif value="{{$review->id}}">
                                    </div>
                                </span>
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
<script>
$(document).on('change', '.switch', function(e) {
    var review_id = $(this).val();
    if ($(this).prop('checked')==true){ 
        var status = '1';
    }else{
        var status = '0';
    }
    
    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "{{ route('change_review_status') }}",
        method: 'POST',
        data: {_token: _token, review_id:review_id, status:status},
        success: function (data) { 
            
        }

    }); 
});
</script>
@endpush