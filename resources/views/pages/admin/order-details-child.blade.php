<div class="col-lg-12">
    @php
        $all_status = array();
    @endphp

    @foreach($status_details as $status)
        <?php $all_status[] = $status->status_name ?>
    @endforeach

    @foreach($status_details as $status)
    @if ($status->status_name == 'Placed')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-success">Order Placed at {{$status->order_status_time}} </label>
            @if (!in_array('Packed', $all_status))
                @if (!in_array('Cancelled', $all_status))
                <button type="button" class="btn-blue order_pack">Pack Order</button>
                @endif
            @endif
        </div>
    </div>
    @endif

    @if ($status->status_name == 'Packed')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-success">Order Packed at {{$status->order_status_time}} </label>
            @if (!in_array('Shipped', $all_status))
                @if (!in_array('Cancelled', $all_status))
                <input type="text" name="courier_name" placeholder="Enter courier" class="flex-form-control courier_name">
                <input type="text" name="tracking_number" placeholder="Enter tracking number" class="flex-form-control tracking_number" style="width: 50%;">
                <button type="button" class="btn-blue dispatched_button">Mark as Dispatched</button>
                @endif
            @endif
        </div>
    </div>
    @endif

    @if ($status->status_name == 'Shipped')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-success">Order dispatched at {{$status->order_status_time}} </label>
            <label class="alert alert-info"> Courier name : {{$dispatch_details->courier_name}} || Tracking Number : {{$dispatch_details->tracking_number}} </label>
            @if (!in_array('On the way', $all_status))
                @if (!in_array('Cancelled', $all_status))
                <button type="button" class="btn-blue on_the_way_button">Mark order as Out for delivery</button>
                @endif
            @endif
        </div>
    </div>
    @endif

    @if ($status->status_name == 'On the way')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-success">Order out for delivery at {{$status->order_status_time}} </label>
            @if (!in_array('Delivered', $all_status))
                @if (!in_array('Cancelled', $all_status))
                <button type="button" class="btn-blue order_delivered_button">Mark order as Deliverd</button>
                @endif
            @endif
        </div>
    </div>
    @endif

    @if ($status->status_name == 'Delivered')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-success">Order delivered at {{$status->order_status_time}} </label>
        </div>
    </div>
    @endif

    @if ($status->status_name == 'Cancelled')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-danger">Order cancelled at {{$status->order_status_time}} </label>
        </div>
    </div>
    @endif
    @endforeach

    @if (!in_array('Cancelled', $all_status))
        @if (!in_array('Delivered', $all_status))
        <button type="button" class="btn-blue cancel_order">Cancel Order</button>
        @endif
    @endif
</div>