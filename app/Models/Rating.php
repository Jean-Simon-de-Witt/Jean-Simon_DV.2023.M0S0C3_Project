<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'listing_id', 'score', 'review'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
