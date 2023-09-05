<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $table = 'user_details';

    protected $appends = ['profile_image_link'];

    public function getProfileImageLinkAttribute(){
        if($this->profile_image == NULL || $this->profile_image == ''){
            return '';
        }
        return url('storage/uploads/profile_image/'.$this->profile_image);
    }

}
