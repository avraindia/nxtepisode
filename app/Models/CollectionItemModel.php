<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionItemModel extends Model
{
    use HasFactory;
    protected $table = 'collection_item';
    protected $appends = ['section_image_link'];

    public function getSectionImageLinkAttribute(){
        if($this->image_name == NULL || $this->image_name == ''){
            return url('images/workout.png');
        }
        return url('storage/uploads/section_image/'.$this->image_name);
    }
}

