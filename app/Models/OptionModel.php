<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{
    use HasFactory;
    protected $table = 'options';

    public function option_values() {
        return $this->hasMany(OptionValueModel::class, 'option_id');
    }
}

