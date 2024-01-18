<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSectionModel extends Model
{
    use HasFactory;
    protected $table = 'homepage_section';

    public function section_products() {
        return $this->hasMany(SectionProductModel::class, 'section_id')->with('product_details');
    }

    public function section_collection() {
        return $this->hasMany(CollectionItemModel::class, 'section_id')->orderBy("item_order", "asc");
    }

}

