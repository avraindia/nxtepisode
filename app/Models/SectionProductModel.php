<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionProductModel extends Model
{
    use HasFactory;
    protected $table = 'section_product';

    public function product_details() {
        return $this->belongsTo(VariationModel::class, 'product_id', 'id')->with('gallery_images')->with('fitting_name')->with('parent_product_details')->with('product_gender');
    }
}