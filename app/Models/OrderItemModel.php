<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;
    protected $table = 'order_item';
    public $timestamps = false;
    protected $appends = ['size_name', 'fitting_type', 'product_image'];

    public function getSizeNameAttribute(){
        if($this->size_id !== NULL || $this->size_id !== ''){
            $size = OptionValueModel::where('id', $this->size_id)->get()->first(); 
            $size_name = $size->option_value;

            return $size_name;
        }
    }

    public function getFittingTypeAttribute(){
        if($this->product_id !== NULL || $this->product_id !== ''){
            $product = VariationModel::where('id', $this->product_id)->get()->first();
            $fitting_type =  TypeModel::where('id', $product->fitting_type)->get()->first();

            $fitting_type_name = $fitting_type->type_name;
            return $fitting_type_name;
        }
    }

    public function getProductImageAttribute() {
        if($this->product_id !== NULL || $this->product_id !== ''){
            $image_list = ProductgalleryModel::where('product_variation_id',$this->product_id)->get()->first();
            $image_name = $image_list->product_image;
            return url('storage/uploads/product_details/'.$image_name);
        }
    }
}

