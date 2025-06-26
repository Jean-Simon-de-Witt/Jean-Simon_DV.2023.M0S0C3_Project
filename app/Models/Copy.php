<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    /** @use HasFactory<\Database\Factories\CopyFactory> */
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = ['listing_id', 'cart_id'];

    public function listing() {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
