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
            <!-- <input type="text" name="courier_name" placeholder="Enter courier" class="flex-form-control courier_name">
                <input type="text" name="tracking_number" placeholder="Enter tracking number" class="flex-form-control tracking_number" style="width: 50%;">
                <button type="button" class="btn-blue dispatched_button">Mark as Dispatched</button> -->

            <form>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Item Length</label>
                                    <input type="text" class="form-control length" placeholder="Ex: 0.5" value="" name="length" required>
                                    <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The length of the item in cms. Must be more than 0.5.</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Item Breadth</label>
                                    <input type="text" class="form-control beadth" placeholder="Ex: 0.5" value="" name="beadth" required>
                                    <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The breadth of the item in cms. Must be more than 0.5.</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Item Height</label>
                                    <input type="text" class="form-control height" placeholder="Ex: 0.5" value="" name="height" required>
                                    <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The height of the item in cms. Must be more than 0.5.</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label">Item Weight</label>
                                    <input type="text" class="form-control weight" placeholder="Ex: 0.5" value="" name="weight" required>
                                    <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The weight of the item in kgs. Must be more than 0.</label>
                                </div>
                            </div>
                            <button type="button" class="btn-blue dispatched_button">Order Mark as Dispatched</button>
                            <div class="alert ship_resp"></div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
            @endif
        </div>
    </div>
    @endif

    @if ($status->status_name == 'Shipped')
    <div class="ors-list">
        <div class="align-items-center d-lg-flex justify-content-between">
            <label class="alert alert-success">Order dispatched at {{$status->order_status_time}} </label>
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
<div class="hori-timeline" dir="ltr">
    <ul class="list-inline events">
        @php
        $all_status = array();
        @endphp

        @foreach($status_details as $status)
        <?php $all_status[] = $status->status_name ?>
        @endforeach

        @foreach($status_details as $status)
            <!-- ORDER PLACED CHECK START -->
            @if ($status->status_name == 'Placed')
            <li class="list-inline-item event-list">
                <div class="px-4">
                    <div class="event-date bg-soft-success text-success">{{$status->order_status_time}}</div>
                    <h5 class="font-size-16">Order Placed at</h5>
                </div>
                @if (!in_array('Packed', $all_status))
                @if (!in_array('Cancelled', $all_status))
                <button type="button" class="btn-blue order_pack">Pack Order</button>
                @endif
                @endif
            </li>
            @endif
            <!-- ORDER PLACED CHECK END -->

            <!-- ORDER PACKED CHECK START -->
            @if ($status->status_name == 'Packed')
            <div class="ors-list">
                <div class="align-items-center d-lg-flex justify-content-between">
                    <label class="alert alert-success">Order Packed at {{$status->order_status_time}} </label>
                    @if (!in_array('Shipped', $all_status))
                    @if (!in_array('Cancelled', $all_status))
                    <form>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="label">Item Length</label>
                                            <input type="text" class="form-control length" placeholder="Ex: 0.5" value="" name="length" required>
                                            <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The length of the item in cms. Must be more than 0.5.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="label">Item Breadth</label>
                                            <input type="text" class="form-control beadth" placeholder="Ex: 0.5" value="" name="beadth" required>
                                            <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The breadth of the item in cms. Must be more than 0.5.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="label">Item Height</label>
                                            <input type="text" class="form-control height" placeholder="Ex: 0.5" value="" name="height" required>
                                            <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The height of the item in cms. Must be more than 0.5.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="label">Item Weight</label>
                                            <input type="text" class="form-control weight" placeholder="Ex: 0.5" value="" name="weight" required>
                                            <label class="input-info"><img src="{{ asset('backend/images/icon/icon-eye.svg') }}" alt=""> The weight of the item in kgs. Must be more than 0.</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-blue dispatched_button">Order Mark as Dispatched</button>
                                    <div class="alert ship_resp"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @endif
                </div>
            </div>
            @endif
            <!-- ORDER PACKED CHECK END -->
        @endforeach
        @if (!in_array('Cancelled', $all_status))
        @if (!in_array('Delivered', $all_status))
        <button type="button" class="btn-blue cancel_order">Cancel Order</button>
        @endif
        @endif

        <!--<li class="list-inline-item event-list">
            <div class="px-4">
                <div class="event-date bg-soft-success text-success">2024-02-10 15:53:59</div>
                <h5 class="font-size-16">Order Placed at</h5>
            </div>
        </li>
        <li class="list-inline-item event-list">
            <div class="px-4">
                <div class="event-date bg-soft-success text-success">2024-02-10 15:53:59</div>
                <h5 class="font-size-16">Order Placed at</h5>
            </div>
        </li>
        <li class="list-inline-item event-list">
            <div class="px-4">
                <div class="event-date bg-soft-success text-success">2024-02-10 15:53:59</div>
                <h5 class="font-size-16">Order Placed at</h5>
            </div>
        </li>
        <li class="list-inline-item event-list">
            <div class="px-4">
                <div class="event-date bg-soft-success text-success">2024-02-10 15:53:59</div>
                <h5 class="font-size-16">Order Placed at</h5>
            </div>
        </li>
        <li class="list-inline-item event-list">
            <div class="px-4">
                <div class="event-date bg-soft-danger text-danger">2024-02-10 15:53:59</div>
                <h5 class="font-size-16">Order Cancel at</h5>
            </div>
        </li>-->
    </ul>
</div>