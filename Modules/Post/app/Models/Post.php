<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Models\User;
use Modules\Post\Database\Factories\PostFactory;
use Modules\Post\Traits\HasFilter;

class Post extends Model
{
    use HasFactory, HasFilter;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'image',
        'description',
        'user_id',
        'post_category_id',
        'is_published',
        'anons',
    ];

     protected static function newFactory(): PostFactory
     {
          return PostFactory::new();
     }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function getImagePathAttribute()
    {
        return asset(\Illuminate\Support\Facades\Storage::url($this->image));
    }
}
