<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);">Product Name</a></th>
            <th><a href="javascript:void(0);">Default MRP.</a></th>
            <th><a href="javascript:void(0);">Category</a></th>
            <th><a href="javascript:void(0);">Sizes</a></th>
            <th><a href="javascript:void(0);">Variation Price</a></th>
            <th><a href="javascript:void(0);">Current Stock</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventories as $inventory)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$inventory->product_title}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$inventory->product_mrp}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$inventory->name}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$inventory->option_value}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$inventory->inventory_price}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$inventory->current_stock}}
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $inventories->links() !!}
</div>