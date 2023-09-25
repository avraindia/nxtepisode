<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $appends = [ 'product_category'];

    public function options() {
        return $this->hasMany(OptionModel::class);
    }

    public function getProductCategoryAttribute(){
        if($this->main_cat_id !== NULL || $this->main_cat_id !== ''){
            $category_rec = CategoryModel::where('id', $this->main_cat_id)->get()->first();
            $category_name = $category_rec->name;
            return $category_name;
        }
    }
}

