<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = ['user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function copies() {
        return $this->hasMany(Copy::class, 'cart_id');
    }
}
