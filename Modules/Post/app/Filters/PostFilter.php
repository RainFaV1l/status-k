<?php

namespace Modules\Post\Filters;

use Illuminate\Database\Eloquent\Builder;
use Modules\Post\Models\PostCategory;

class PostFilter extends Filter
{
    /**
     * Фильтрация по названию
     *
     * @param string $value
     * @return Builder
     */
    protected function title(string $value): Builder
    {
        return $this->builder->where('title', 'like', '%' . $value . '%');
    }

    /**
     * Фильтрация по категории
     *
     * @param string $value
     * @return Builder
     */
    protected function category(string $value): Builder
    {
        $category = PostCategory::query()->where('name', $value)->firstOrFail();

        return $this->builder->where('post_category_id', $category->id);
    }

    /**
     * Фильтрация по названию
     *
     * @param int $userId
     * @return Builder
     */
    protected function userId(int $userId): Builder
    {
        return $this->builder->where('user_id', $userId);
    }
}
