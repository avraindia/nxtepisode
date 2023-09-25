<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizegalleryModel extends Model
{
    use HasFactory;
    protected $table = 'size_gallery';
    protected $appends = ['size_gallery_image_link'];

    public function getSizeGalleryImageLinkAttribute(){
        if($this->size_image == NULL || $this->size_image == ''){
            return url('images/workout.png');
        }
        return url('storage/uploads/size_chart/'.$this->size_image);
    }
}

