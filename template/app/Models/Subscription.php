<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    public $incrementing = false; // Karena pakai UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'amount',
        'payment_type',
        'status',
        'date_limit',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
