<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;
    protected $primaryKey = 'payment_method_id';
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'card_type', 'card_number', 'card_cvv', 'card_expiry_date'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
