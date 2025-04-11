<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'id',
        'id_user',
        'id_content',
        'id_comment',
        'id_reported_user',
        'reason',
        'detail',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'id_comment');
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'id_reported_user');
    }
}
