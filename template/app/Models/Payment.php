<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'amount',
        'payment_type',
        'status',
        'transaction_id',
        'midtrans_response',
    ];

    protected $casts = [
        'midtrans_response' => 'array',
    ];
}
