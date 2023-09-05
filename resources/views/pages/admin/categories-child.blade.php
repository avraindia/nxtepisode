<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);" class="sort_item" item="categories.name">Name</a></th>
            <th>Status</th>
            <th>action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($all_categories as $category)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$category->name}}
                </span>
            </td>
            <td>
                <div class="order-place-tag them-color">
                @if($category->is_active =='1')
                    Published
                @else
                    Unpublished
                @endif
                </div>
            </td>
            <td class="">
                <div class="btn-group dropstart">
                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>
                    <ul class="dropdown-menu svg-icon">
                        <li> <a href="javascript:void(0);" class="edit_cat_btn" cat_id="{{$category->id}}">Edit  </a> </li>
                        <li> <a onclick="return confirm('Are you sure to delete?')" href="{{route('category_delete', $category->id)}}">Delete</a> </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $all_categories->links() !!}
</div>