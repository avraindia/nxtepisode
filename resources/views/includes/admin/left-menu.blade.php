<div class="navigation">
    <div class="logo-box">
        <a href="">
            <img src="{{ asset('backend/images/logo.png') }}" class="img-fluid" alt="" style="width:100px;">
        </a>
    </div>
    @php
        $route_name = request()-> route()-> getname();
    @endphp
    <ul>
        <li @if(in_array($route_name, ['dashboard'])) ? class="hovered" : '' @endif>
            <a href="{{route('dashboard')}}">
                <span class="menu-icon">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li @if(in_array($route_name, ['users', 'add_user', 'user_details'])) ? class="hovered" : '' @endif>
            <a href="{{route('users')}}">
                <span class="menu-icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </span>
                <span class="menu-title">Admin Users</span>
            </a>
        </li>
        <li @if(in_array($route_name, ['customers', 'customer_details'])) ? class="hovered" : '' @endif>
            <a href="{{route('customers')}}">
                <span class="menu-icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </span>
                <span class="menu-title">Customers</span>
            </a>
        </li>
    </ul>
</div>