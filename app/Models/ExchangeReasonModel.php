<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeReasonModel extends Model
{
    use HasFactory;
    protected $table = 'exchange_reason';
    public $timestamps = false;
}

