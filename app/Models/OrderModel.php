<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $appends = ['order_status_id'];


    public function order_items() {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }

    public function user_details() {
        return $this->belongsTo(UserDetails::class, 'customer_id', 'user_id');
    }

    public function shipping_address() {
        return $this->belongsTo(CheckoutAddressModel::class, 'checkout_adress_id', 'id');
    }
}

