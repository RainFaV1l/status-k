<?php

namespace Modules\Post\Traits;

use Illuminate\Database\Eloquent\Builder;
use Modules\Post\Filters\Filter;

/**
 * Trait HasFilter
 *
 * @method static Builder filter(Filter $filter)
 */
trait HasFilter
{
    /**
     * @param Builder $builder
     * @param Filter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, Filter $filter): Builder
    {
        return $filter->apply($builder);
    }
}
