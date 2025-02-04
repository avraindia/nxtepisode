<ul class="list-group section-product-list-group">
    @foreach($products as $product)
        <li class="list-group-item">
            <div class="form-check">
                <input class="form-check-input add_product_section_btn product-check-box" type="checkbox" value="{{$product->id}}" id="flexCheckDefault" <?php if(in_array($product->id, $productIdArr)){echo "checked";} ?>>
                @foreach($product->gallery_images as $image)
                    @php
                    $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                    @endphp
                    <img class="section-product-list-images" src="{{$product_thumbnail_image_link}}" alt="">
                @endforeach
                <label class="form-check-label" for="flexCheckDefault">
                    {{$product->fitting_title}} 
                </label>
            </div>
        </li>
    @endforeach
</ul>
<div class="pagination-section">
    {!! $products->links() !!}
</div>