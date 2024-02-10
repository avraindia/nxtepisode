<div class="col-lg-3 col-md-12">
    <div class="place-order-section">
        <div class="billing-details">
            <div class="order-owner-name-email-text">
                <h5>{{$user_details->full_name}}</h5>
                <p>{{$user_details->email}}</p>
            </div>
            <div class="billing-price-section order-list-section">
                <ul>
                    <li><a class="track-order-btn" href="{{route('my_order')}}">Orders <!--<span class="track-order-text">(Track your order here)</span>--> </a></li>
                </ul>
            </div>
            <div class="billing-price-section">
                <ul>
                    <li><a class="track-order-btn" href="{{route('profile')}}">Profile</a></li>
                </ul>
            </div>
        </div>
        <div class="place-order-btn">
            <a href="javascript:void(0);" onclick="javascript:logoutFunction();">Logout</a>
        </div>
    </div>
</div>