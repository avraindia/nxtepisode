<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);" class="sort_item" item="user_details.full_name">Creator Name</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="user_details.email">Creator Email</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="service.name">Title</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="service.location">Location</a></th>
            <th>Rating</th>
            <th>Hashtags</th>
            <th class="text-center">action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$service->author->name}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$service->author->email}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$service->name}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$service->location}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{number_format((float)$service->average_rating, 1, '.', '')}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$service->tags}}
                </span>
            </td>
            <td class="text-center">
                <div class="btn-group dropstart">
                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>
                    <ul class="dropdown-menu svg-icon">
                        <li> <a href="{{route('service_details', $service->id)}}">Details</a> </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $services->links() !!}
</div>