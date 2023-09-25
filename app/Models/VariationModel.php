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
}

