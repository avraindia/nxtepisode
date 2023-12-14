<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCatalogModel extends Model
{
    use HasFactory;
    protected $table = 'status_catalog';
    public $timestamps = false;
}

