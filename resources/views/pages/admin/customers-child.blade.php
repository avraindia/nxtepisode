<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th><a href="javascript:void(0);" class="sort_item" item="users.name">Name</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="users.email">Email</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="users.email">Phone</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="users.email">Gender</a></th>
            <th><a href="javascript:void(0);" class="sort_item" item="users.created_at">Registration Date</a></th>
            <th class="text-center">action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="table-body-tr">
            <td>
                <span class="pr-title">
                    {{$user->name}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$user->email}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{$user->phone_number}}
                </span>
            </td>
            <td>
                <span class="pr-title">
                    @if($user->gender =='m')
                        Male
                    @else
                        Female
                    @endif
                </span>
            </td>
            <td>
                <span class="pr-title">
                    {{date('d.m.Y', strtotime($user->created_at))}}
                </span>
            </td>
            <td class="text-center">
                <div class="btn-group dropstart">
                    <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </button>
                    <ul class="dropdown-menu svg-icon">
                        <li> <a href="{{ route('customer_details',$user->id) }}">User Details</a> </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $users->links() !!}
</div>