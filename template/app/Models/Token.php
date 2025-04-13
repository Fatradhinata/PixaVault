<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'action',
        'target',
        'is_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'target');
    }
}
