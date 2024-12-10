<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Database\Factories\PostCategoryFactory;

class PostCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];

     protected static function newFactory(): PostCategoryFactory
     {
          return PostCategoryFactory::new();
     }

    public function posts() {
        return $this->hasMany(Post::class, 'post_category_id');
    }
}
