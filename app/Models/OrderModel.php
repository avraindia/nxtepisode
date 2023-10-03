<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'order';

    public function order_items() {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }
}

