<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    /** @use HasFactory<\Database\Factories\ListingFactory> */
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'user_id', 'description', 'price', 'category', 'image', 'rating'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function copies() {
        return $this->hasMany(Copy::class, 'listing_id');
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'listing_id');
    }
}
