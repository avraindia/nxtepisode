<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);" class="sort_item" item="rental_platform.platform_name">Rental Platform Name</a></th>
            <th>Icon</th>
            <th>Status</th>
            <th>action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($platforms as $platform)
        <tr class="table-body-tr"> 
            <td> <span class="pr-title">{{$platform->platform_name}}</span> </td>
            <td><img src="{{$platform->platform_media_link}}"></td>
            <td>
                <div class="order-place-tag them-color">
                @if($platform->is_active =='1')
                    Active
                @else
                    Inactive
                @endif
                </div>
            </td>
            <td class="">
                <div class="btn-group dropstart">
                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>
                    <ul class="dropdown-menu svg-icon">
                        <li> <a href="{{ route('edit_rental_platform', $platform->id) }}"> Edit  </a> </li>
                    </ul>
                </div>
            </td>
        </tr> 
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $platforms->links() !!}
</div>