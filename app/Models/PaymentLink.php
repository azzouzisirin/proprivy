<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount_due', 'status', 'commission', 'net_amount',
    ];
}
