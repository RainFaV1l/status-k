<?php

namespace Modules\Auth\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{
    /**
     * Фильтрация по названию
     *
     * @param int $userId
     * @return Builder
     */
    protected function userId(int $userId): Builder
    {
        return $this->builder->where('id', $userId);
    }
}
