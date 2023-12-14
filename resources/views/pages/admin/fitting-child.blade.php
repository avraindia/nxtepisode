<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);">Product Name</a></th>
            <th><a href="javascript:void(0);">Fitting Title</a></th>
            <th><a href="javascript:void(0);">Default MRP.</a></th>
            <th><a href="javascript:void(0);">Fitting Type</a></th>
            <th><a href="javascript:void(0);">Gender</a></th>
            <th><a href="javascript:void(0);">Status</a></th>
            <th><a href="javascript:void(0);">Reviews</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($fittings as $fitting)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$fitting->product_title}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$fitting->fitting_title}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$fitting->product_mrp}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$fitting->type_name}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$fitting->gender}}
                </span>
            </td>
            <td>
                <div class="order-place-tag them-color">
                @if($fitting->is_active =='1')
                    Available
                @else
                    Unavailable
                @endif
                </div>
            </td>
            <td>
                <a href="{{route('fetch_review', $fitting->id)}}" class="btn btn-outline-success">Reviews</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $fittings->links() !!}
</div>