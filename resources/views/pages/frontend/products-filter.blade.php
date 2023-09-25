<div class="col-lg-3 col-md-4 col-12">
    <div class="add-class-for-responsive" id="responsive-filter-option-section">
        <div class="product-select-search-section product-select-responsive">
            <select name="cars" id="products" class="order_by_mobile">
                <option selected disabled>Select Sorting Options</option>
                <option value="price_high_to_low">Price-High to Low</option>
                <option value="price_low_to_high">Price-Low to High</option>
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>
        <div class="product-responsive-filter-btn">
            <button class="acc filter-button active-filter-btn" data-filter="categories">Categories</button>
            <button class="acc filter-button" data-filter="themes">THEMES</button>
            <button class="acc filter-button" data-filter="size">Size</button>
            <button class="acc filter-button" data-filter="gender">Gender</button>
            <button class="acc filter-button" data-filter="stock">Stock</button>
            <button class="acc filter-button" data-filter="prices">Prices</button>
        </div>
        <div class="product-left-right-section">
            <div class="product-section padding-section filter categories">
                <div class="filter-section-header-text">
                    <h5>Categories</h5>
                </div>
                <!--<div class="product-section-search-input">
                    <input type="text" placeholder="Search for Categories">
                </div>-->
                <div class="product-section-check-box">
                    @foreach($categories as $category)
                    <input type="checkbox" class="product_cat" name="product_cat" id="{{$category->name}}" value="{{$category->id}}">
                    <label for="{{$category->name}}">{{$category->name}}</label>
                    @endforeach
                </div>
                <!--<div class="more-product-chekbox-btn">
                    <a href="javascript:void(0)">+ 8 more</a>
                </div>-->
            </div>
            <div class="filter-section-devider"></div>
            <div class="themes-section padding-section responsive-style  filter themes">
                <div class="filter-section-header-text">
                    <h5>THEMES</h5>
                </div>
                <!-- <div class="product-section-search-input">
                    <input type="text" placeholder="Search for Themes">
                </div> -->
                <div class="product-section-check-box">
                    @foreach($all_themes as $theme)
                    <input type="checkbox" class="product_theme" name="product_theme" id="{{$theme->theme_name}}" value="{{$theme->id}}">
                    <label for="{{$theme->theme_name}}">{{$theme->theme_name}}</label>
                    @endforeach
                </div>
                <!-- <div class="more-product-chekbox-btn">
                    <a href="javascript:void(0)">+ 6 more</a>
                </div> -->
            </div>
           <div class="filter-section-devider"></div>

            <div class="gender-section padding-section responsive-style filter gender">
                <div class="filter-section-header-text">
                    <h5>Fitting type</h5>
                </div>
                <div class="product-radio-input-section">
                    @foreach($types as $type)
                    <input type="radio" id="{{$type->type_name}}" class="fitting_type" name="fitting_type" value="{{$type->id}}">
                    <label for="{{$type->type_name}}">{{$type->type_name}}</label>
                    @endforeach
                </div>
            </div>

            <div class="filter-section-devider"></div>
            @foreach($options as $option)
            <div class="size-section padding-section responsive-style filter size">
                <div class="filter-section-header-text">
                    <h5>{{$option->option_name}}</h5>
                </div>
                <div class="size-select-btn">
                    @foreach($option->option_values as $option_value)
                        <label>
                            <input type="checkbox" class="option_value" name="option_value" value="{{$option_value->id}}"><span>{{$option_value->option_value}}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="filter-section-devider"></div>
            <div class="gender-section padding-section responsive-style filter gender">
                <div class="filter-section-header-text">
                    <h5>GENDER</h5>
                </div>
                <div class="product-radio-input-section">
                    @foreach($genders as $gender)
                    <input type="radio" id="{{$gender->gender}}" class="product_gender" name="product_gender" value="{{$gender->id}}">
                    <label for="{{$gender->gender}}">{{$gender->gender}}</label>
                    @endforeach
                </div>
            </div>

            <div class="filter-section-devider"></div>
            <div class="stock-section padding-section responsive-style filter stock">
                <div class="filter-section-header-text">
                    <h5>STOCK</h5>
                </div>
                <div class="product-radio-input-section">
                    <input type="radio" id="in-stock" class="product_stock" name="product_stock" value="1">
                    <label for="in-stock">In Stock</label>
                    <input type="radio" id="out-stock" class="product_stock" name="product_stock" value="0">
                    <label for="out-stock">Out Of Stock</label>
                </div>
            </div>
            <div class="filter-section-devider"></div>
            <div class="price-section padding-section responsive-style filter prices">
                <div class="filter-section-header-text">
                    <h5>PRICES</h5>
                </div>
                <div class="price-input-form">
                    <div class="row g-md-2">
                        <div class="col-md-6 col-6">
                            <div class="product-section-search-input">
                                <input type="number" class="from_price" placeholder="Form">
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="product-section-search-input">
                                <input type="number" class="to_price" placeholder="To">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="responsive-clear-option-btn">
            <div class="clear-all-btn">
                <button>Clear All</button>
            </div>
            <div class="filter-option-btn">
                <button id="hide-filter-option-section" class="close-btn">Close</button>
                <button class="apply-btn">Apply</button>
            </div>
        </div>
    </div>
</div>