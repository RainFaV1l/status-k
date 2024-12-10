<?php

namespace Modules\Auth\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Auth\Database\Factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Modules\Post\Models\Post;
use Modules\Auth\Traits\HasFilter;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasFilter;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'user_role_id',
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

     protected static function newFactory(): UserFactory
     {
          return UserFactory::new();
     }

     public function role()
     {
         return $this->belongsTo(UserRole::class, 'user_role_id');
     }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
