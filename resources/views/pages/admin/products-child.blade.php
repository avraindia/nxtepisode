<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);">Product Name</a></th>
            <th><a href="javascript:void(0);">Product MRP.</a></th>
            <th><a href="javascript:void(0);">Category</a></th>
            <th>Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$product->product_title}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$product->product_mrp}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$product->category_name}}
                </span>
            </td>
            <td>
                <div class="order-place-tag them-color">
                @if($product->status =='1')
                    Available
                @else
                    Unavailable
                @endif
                </div>
            </td>
            <td class="text-center">
                <div class="btn-group dropstart">
                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>
                    <ul class="dropdown-menu svg-icon">
                        <li> <a href="{{route('product_details', $product->id)}}">Details</a> </li>
                        <li> <a href="{{route('fitting_list', $product->id)}}">Fittings</a> </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $products->links() !!}
</div>