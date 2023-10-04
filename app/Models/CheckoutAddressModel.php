<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutAddressModel extends Model
{
    use HasFactory;
    protected $table = 'checkout_address';
    protected $appends = ['state_name'];

    public function getStateNameAttribute(){
        if($this->state !== NULL || $this->state !== ''){
            $state = StateModel::where('id', $this->state)->get()->first(); 
            $state_name = $state->name;

            return $state_name;
        }
    }
}

