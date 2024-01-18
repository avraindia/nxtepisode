<ul class="list-group">
    @foreach($products as $product)
        <li class="list-group-item">
            <div class="form-check">
                <input class="form-check-input add_product_section_btn" type="checkbox" value="{{$product->id}}" id="flexCheckDefault" <?php if(in_array($product->id, $productIdArr)){echo "checked";} ?>>
                <label class="form-check-label" for="flexCheckDefault">
                    {{$product->fitting_title}} 
                </label>
                @foreach($product->gallery_images as $image)
                    @php
                    $product_thumbnail_image_link = $image->product_thumbnail_image_link;
                    @endphp
                    <img src="{{$product_thumbnail_image_link}}" alt="" style="width: 50px;">
                @endforeach
            </div>
        </li>
    @endforeach
</ul>
<div class="pagination-section">
    {!! $products->links() !!}
</div>