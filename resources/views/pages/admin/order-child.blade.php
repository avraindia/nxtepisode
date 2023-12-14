<table class="display coustom-table nowrap w-100 Queries">
    <thead>
        <tr>
            <th>Order number</th>
            <th>total  </th>
            <th> name </th>
            <th> email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Payment Mode</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order_list as $single_order)
        @php
            $order_status = App\Http\Controllers\AdminController::last_status_of_order($single_order->id);
        @endphp
        <tr class="table-body-tr">
            <td> <span class="pr-title">#{{$single_order->order_number}}</span> </td>
            <td>₹ {{$single_order->final_price}}</td>
            <td>  {{$single_order->first_name}} {{$single_order->last_name}} </td>
            <td> {{$single_order->email}}</td>
            <td>{{$single_order->phone_no}}</td>
            <td><div class="order-place-tag them-color"><span class="pr-title">{{$order_status->status_name}}</span></div></td>
            <td><div class="order-place-tag them-color"><span class="pr-title">{{ucfirst($single_order->payment_type)}}</span></div></td>
            <td class="">
            <div class="btn-group dropstart">
                <button type="button" class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-dots-vertical-rounded'></i>
                </button>
                <ul class="dropdown-menu svg-icon">
                    <li> <a href="{{ route('view_order', $single_order->id) }}"> View Order  </a> </li>
                </ul>
            </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-section">
    {!! $order_list->links() !!}
</div>