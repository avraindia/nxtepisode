<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageBannerModel extends Model
{
    use HasFactory;
    protected $table = 'homepage_banner';
    protected $appends = ['homepage_banner_link'];

    public function getHomepageBannerLinkAttribute(){
        if($this->image_name == NULL || $this->image_name == ''){
            return url('images/workout.png');
        }
        return url('storage/uploads/banner_image/'.$this->image_name);
    }
}

