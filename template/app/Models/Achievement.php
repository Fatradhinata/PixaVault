<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'achievements';
    protected $fillable = [
        'user_id',
        'title',
        'tier',
        'badge',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
