<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CommentLike extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'comment_likes';
    protected $fillable = ['id', 'comment_id', 'user_id'];
    public $timestamps = true; 
    public $incrementing = false; // Nonaktifkan auto-increment karena pakai UUID
    protected $keyType = 'string'; // UUID adalah string

    // Relasi ke Comment
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
