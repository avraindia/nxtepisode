<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductgalleryModel extends Model
{
    use HasFactory;
    protected $table = 'product_gallery';
    protected $appends = ['product_thumbnail_image_link', 'product_details_image_link'];

    public function getProductThumbnailImageLinkAttribute(){
        if($this->product_image == NULL || $this->product_image == ''){
            return url('images/workout.png');
        }
        return url('storage/uploads/product_thumbnails/'.$this->product_image);
    }

    public function getProductDetailsImageLinkAttribute(){
        if($this->product_image == NULL || $this->product_image == ''){
            return url('images/workout.png');
        }
        return url('storage/uploads/product_details/'.$this->product_image);
    }
}

