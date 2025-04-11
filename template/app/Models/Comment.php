<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasUuids;
    
    protected $table = 'comments';
    protected $fillable = [
        'id', 
        'id_user', 
        'id_content', 
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
    
    public function likes()
    {
        return $this->hasMany(CommentLike::class, 'comment_id');
    }

}
