<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'photo',
        'age',
        'verification_token',
        'birthdate',
        'status',
        'about_me',
        'gender',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // relations:

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // other roles:
    public function buyer()
    {
        return $this->hasOne(Buyer::class);
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    // messages:
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function contacts()
    {
        $sentIds = $this->sentMessages()->pluck('receiver_id')->toArray();
        $receivedIds = $this->receivedMessages()->pluck('sender_id')->toArray();

        $allIds = collect($sentIds)->merge($receivedIds)->unique();

        // $allIds = array_unique(array_merge($sentIds, $receivedIds));

        return User::whereIn('id', $allIds)->get();
    }


    // posts:
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
