<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);" class="sort_item" item="user_details.full_name">Creator Name</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="user_details.email">Creator Email</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="experience.title">Title</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="experience.rating">Rating</a></th>
            <th>Hashtags</th>
            <th>Report Number</th>
            <th>Status</th>
            <th class="text-center">action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($experiences as $experience)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$experience->author->name}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$experience->author->email}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$experience->title}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$experience->rating}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$experience->tags}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$experience->report_count}}
                </span>
            </td>
            <td>
                <div class="order-place-tag them-color">
                @if($experience->is_block =='0')
                    Active
                @else
                    Blocked
                @endif
                </div>
            </td>
            <td class="text-center">
                <div class="btn-group dropstart">
                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>
                    <ul class="dropdown-menu svg-icon">
                        <li> <a href="{{route('experience_details', $experience->id)}}">Details</a> </li>
                        @if($experience->is_block =='0')
                            <li> <a href="javascript:void(0);" class="block_unblock_btn" action="block" id_experience="{{$experience->id}}">Block</a> </li>
                        @endif
                        @if($experience->is_block =='1') 
                            <li> <a href="javascript:void(0);" class="block_unblock_btn" action="unblock" id_experience="{{$experience->id}}">Unblock</a> </li>
                        @endif
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $experiences->links() !!}
</div>