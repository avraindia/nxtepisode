<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="true-speedy-gmail-ph-number">
                    <a href="tel:(12345)67890"><i class="fa-sharp fa-solid fa-phone"></i> &nbsp;(12345)67890</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-wishlist">
                    @if (auth()->check())
                    <a href="{{route('frontlogout')}}">Logout</a>
                    @else
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    @endif
                    <a href="#">Wishlist</a>
                    <a class="cart-icon" href="#">
                        <div class="product-cart-icon">
                            <div class="product-cart-number">
                                <div class="product-number-text">
                                @if (auth()->check())
                                    <a href="{{route('cart')}}"><span class="cart_item_num">{{ Cart::getTotalQuantity()}}</span></a>
                                    @else
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal"><span>0</span></a>
                                    @endif
                                    
                                </div>
                            </div>
                            <img src="{{ asset('frontend/images/cart-icon.png') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="logo-btn-anchor-tag">
                    <div class="logo-btn">
                        <a href="#"><img class="img-fluid" src="{{ asset('frontend/images/next-logo.png') }}" alt=""></a>
                    </div>
                    <div class="main-heder-anchor-tag">
                        <ul>
                            <li class="dropdown">
                                <a class="active-header-btn" href="#">Topwear &nbsp;<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    <ul>
                                        <li><a href="#">category 1</a></li>
                                        <li><a href="#">category 2</a></li>
                                        <li><a href="#">category 3</a></li>
                                        <li><a href="#">category 4</a></li>
                                        <li><a href="#">category 5</a></li>
                                        <li><a href="#">category 6</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#">Bottomwear &nbsp;<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    <ul>
                                        <li><a href="#">category 1</a></li>
                                        <li><a href="#">category 2</a></li>
                                        <li><a href="#">category 3</a></li>
                                        <li><a href="#">category 4</a></li>
                                        <li><a href="#">category 5</a></li>
                                        <li><a href="#">category 6</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#">Shoes & Accessories &nbsp;<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    <ul>
                                        <li><a href="#">category 1</a></li>
                                        <li><a href="#">category 2</a></li>
                                        <li><a href="#">category 3</a></li>
                                        <li><a href="#">category 4</a></li>
                                        <li><a href="#">category 5</a></li>
                                        <li><a href="#">category 6</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#">Shop by Themes &nbsp;<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    <ul>
                                        <li><a href="#">category 1</a></li>
                                        <li><a href="#">category 2</a></li>
                                        <li><a href="#">category 3</a></li>
                                        <li><a href="#">category 4</a></li>
                                        <li><a href="#">category 5</a></li>
                                        <li><a href="#">category 6</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#">Shop by Themes &nbsp;<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    <ul>
                                        <li><a href="#">category 1</a></li>
                                        <li><a href="#">category 2</a></li>
                                        <li><a href="#">category 3</a></li>
                                        <li><a href="#">category 4</a></li>
                                        <li><a href="#">category 5</a></li>
                                        <li><a href="#">category 6</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">Membership</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="main-heder-search-input position-relative">

                    <input type="text">
                    <div class="header-search-btn-icon">
                        <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>