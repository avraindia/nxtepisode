<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationModel extends Model
{
    use HasFactory;
    protected $table = 'product_variation';

    public function gallery_images() {
        return $this->hasMany(ProductgalleryModel::class, 'product_variation_id');
    }

    public function chart_images() {
        return $this->hasMany(SizegalleryModel::class, 'product_variation_id');
    }

    public function fitting_name() {
        return $this->belongsTo(TypeModel::class, 'fitting_type', 'id');
    }

    public function parent_product_details() {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    public function product_gender() {
        return $this->belongsTo(GenderModel::class, 'gender', 'id');
    }
}

