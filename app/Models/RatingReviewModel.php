<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingReviewModel extends Model
{
    use HasFactory;
    protected $table = 'review_rating';

    public function user_details() {
        return $this->belongsTo(UserDetails::class, 'user_id', 'user_id');
    }
}

