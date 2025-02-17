<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Content extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'id_user',
        'name',
        'desc',
        'photo',
        'downloads',
        'likes',
        'views',
        'tags',
    ];
}
