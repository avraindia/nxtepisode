<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeIssueModel extends Model
{
    use HasFactory;
    protected $table = 'exchange_issue';
    public $timestamps = false;
}

