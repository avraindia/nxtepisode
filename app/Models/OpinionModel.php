<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpinionModel extends Model
{
    use HasFactory;
    protected $table = 'public_opinion';
    protected $appends = ['public_opinion_image_link'];

    public function getPublicOpinionImageLinkAttribute(){
        if($this->public_image == NULL || $this->public_image == ''){
            return url('backend/images/img-type1.png');
        }
        return url('storage/uploads/public_opinion/'.$this->public_image);
    }
}

