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
        <li @if(in_array($route_name, ['all_categories', 'add_category', 'edit_category', 'category_delete'])) ? class="hovered" : '' @endif>
            <a href="{{route('all_categories')}}">
                <span class="menu-icon">
                    <img src="{{ asset('backend/images/icon/category.svg') }}" class="img-fluid " alt="">
                </span>
                <span class="menu-title">Category</span>
            </a>
        </li>
        <li @if(in_array($route_name, ['options', 'add_option_value'])) ? class="hovered" : '' @endif>
            <a href="{{route('options')}}">
                <span class="menu-icon">
                    <img src="{{ asset('backend/images/icon/icon-option.png') }}" class="img-fluid " alt="">
                </span>
                <span class="menu-title">Options</span>
            </a>
        </li>
        <li @if(in_array($route_name, ['all_products', 'add_product', 'product_details'])) ? class="hovered" : '' @endif>
            <a href="{{route('all_products')}}">
                <span class="menu-icon">
                    <img src="{{ asset('backend/images/icon/icon-shirt.png') }}" class="img-fluid " alt="">
                </span>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li @if(in_array($route_name, ['inventory_list', 'inventory'])) ? class="hovered" : '' @endif>
            <a href="{{route('inventory_list')}}">
                <span class="menu-icon">
                    <img src="{{ asset('backend/images/icon/icon-inventory.png') }}" class="img-fluid " alt="">
                </span>
                <span class="menu-title">Inventory</span>
            </a>
        </li>
        <li @if(in_array($route_name, ['all_order', 'view_order'])) ? class="hovered" : '' @endif>
            <a href="{{route('all_order')}}">
                <span class="menu-icon">
                    <img src="{{ asset('backend/images/icon/icon-order.svg') }}" class="img-fluid " alt="">
                </span>
                <span class="menu-title">Order</span>
            </a>
        </li>
    </ul>
</div>