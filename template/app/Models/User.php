<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Achievement;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'google_id',
        'google_token',
        'google_refresh_token',
        'full_name',
        'name',
        'bio',
        'email',
        'password',
        'role',
        'phone_number',
        'photo',
        'free_limit',
        'verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'google_id',
        'google_token',
        'google_refresh_token',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function contents()
    {
        return $this->hasMany(Content::class, 'id_user');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }



}
