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
    protected $keyType = 'string';
    public $incrementing = false; 
    protected $fillable = [
        'id',
        'id_user',
        'name',
        'desc',
        'photo',
        'downloads',
        'likes',
        'views',
        'tags',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // Generate UUID otomatis
            }
        });
    }
}
