<section class="desktop-header">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="man-women-btn">
                        <!-- <ul>
                            <li><a href="#">WOMEN</a></li>
                            <li><a href="#" class="active-man-women-btn">MEN</a></li>
                        </ul> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="track-order-contact-us-btn">
                        <ul>
                            <!-- <li><a href="#">Track Order</a></li> -->
                            <li><a href="javascript:void(0);">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <div class="logo-btn-anchor-tag">
                        <div class="logo-btn">
                            <a href="{{route('home')}}"><img class="img-fluid" src="{{ asset('frontend/images/next-logo.png') }}" alt=""></a>
                        </div>
                        <div class="main-heder-anchor-tag">
                            <ul>
                                @foreach($global_categories as $category)
                                <li class="dropdown">
                                    <a href="{{route('products',['cid' => $category->id])}}">{{$category->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header-selected-icon">
                        <div class="header-search-input">
                            <div class="header-search-icon">
                                <a href="javascript:void(0);"><i class="fa-solid fa-magnifying-glass"></i></a>
                            </div>
                            <input class="search-input" type="text" placeholder="What are you looking for?" onkeyup="fetchSuggestion(this);">
                            <ul class="suggestionList"></ul>
                        </div>
                        @if (auth()->check())
                            <a href="javascript:void(0);" id="desktop-dropdown-btn"><i class="fa-regular fa-user"></i>
                            </a>
                                <div class="user-logout-dropdown" id="desktop-dropdown-list">
                                    <ul>
                                        <li><a href="{{route('profile')}}"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Profile</a></li>
                                        <li><a href="{{route('my_order')}}"><i class="fa-solid fa-bag-shopping"></i> &nbsp;My Order</a></li>
                                        <li><a href="javascript:void(0);" onclick="javascript:logoutFunction();"><i class="fa-solid fa-right-from-bracket"></i> &nbsp;Logout</a></li>
                                    </ul>
                                </div>
                        @else
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-regular fa-user"></i></a>
                        @endif
                        <a href="{{route('wishlist')}}"><i class="fa-regular fa-heart"></i></a>
                        @if (auth()->check())
                            <a href="{{route('cart')}}" class="cart-btn">
                                <div class="product-cart-number">
                                    <div class="product-number-text">
                                        <span>{{ Cart::getTotalQuantity()}}</span>
                                    </div>
                                </div>
                                <i class="fa-regular fa-cart-shopping"></i>
                            </a>
                        @else
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal" class="cart-btn">
                                <div class="product-cart-number">
                                    <div class="product-number-text">
                                        <span>0</span>
                                    </div>
                                </div>
                                <i class="fa-regular fa-cart-shopping"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="responsive-header">
    <div class="nav">
        <header class="header">
            <div class="container">
                <nav class="navbar">
                    <a href="index.html" class="brand"><img class="img-fluid" src="{{ asset('frontend/images/next-logo.png') }}"
                            alt=""></a>
                    <div class="burger-phone-icon-section">
                        <div class="header-selected-icon">
                            <a class="responsive-search-icon" href="javascript:void(0);"><i class="fa-solid fa-magnifying-glass"></i></a>
                            @if (auth()->check())
                                <a href="javascript:void(0);"><i class="fa-regular fa-user"></i></a>
                            @else
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-regular fa-user"></i></a>
                            @endif
                            <a href="{{route('wishlist')}}"><i class="fa-regular fa-heart"></i></a>
                            @if (auth()->check())
                                <a href="{{route('cart')}}" class="cart-btn">
                                    <div class="product-cart-number">
                                        <div class="product-number-text">
                                            <span>{{ Cart::getTotalQuantity()}}</span>
                                        </div>
                                    </div>
                                    <i class="fa-regular fa-cart-shopping"></i>
                                </a>
                            @else
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal" class="cart-btn">
                                    <div class="product-cart-number">
                                        <div class="product-number-text">
                                            <span>0</span>
                                        </div>
                                    </div>
                                    <i class="fa-regular fa-cart-shopping"></i>
                                </a>
                            @endif
                        </div>
                        <button type="button" class="burger" id="burger">
                            <span class="burger-line"></span>
                            <span class="burger-line"></span>
                            <span class="burger-line"></span>
                        </button>
                    </div>
                    <span class="overlay" id="overlay"></span>
                    <div class="menu menu-section" id="menu">
                        <div class="responsive-logo-user-name-section">
                            <div class="responsive-logo-menu-image">
                                <img src="{{ asset('frontend/images/next-logo.png') }}" alt="">
                            </div>
                            <!-- <div class="user-name">
                                <h5>Saswata Roy Chowdhury</h5>
                            </div> -->
                        </div>
                        <div class="responsive-filter-menu-section">
                            <div class="filter-menu-ul filter men">
                                <ul class="menu-block">
                                    @foreach($global_categories as $category)
                                    <li class="menu-item">
                                        <a class="menu-link" href="javascript:void(0);">{{$category->name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="responsive-account-btn">
                            <ul>
                                <!-- <li><a href="#">My Account</a></li>
                                <li><a href="#">My Orders</a></li> -->
                                <li><a href="javascript:void(0);">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="responsive-search-input" style="display: none;">
                    <div class="responive-search-cancle-btn">
                        <button class="cancel-responsive-search"><i class="fa-regular fa-xmark"></i></button>
                    </div>
                    <div class="header-search-icon">
                        <a href="javascript:void(0);"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                    <input onkeyup="fetchSuggestion(this);" type="text" placeholder="What are you looking for?">
                    <ul class="suggestionList"></ul>
                </div>
            </div>
        </header>
    </div>
</section>