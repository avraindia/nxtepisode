<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class CategoryModel extends Model

{

    use HasFactory;



    protected $table = 'category';



    protected $appends = ['category_image_link'];



    public function getCategoryImageLinkAttribute(){

        if($this->category_image == NULL || $this->category_image == ''){

            return url('backend/images/img-type1.png');

        }

        return url('storage/uploads/category_image/'.$this->category_image);

    }

}

