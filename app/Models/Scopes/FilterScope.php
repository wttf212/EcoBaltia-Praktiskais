<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     * @return void
     * Possible to split each filter into separate function
     */
    public function apply(Builder $builder, Model $model): void
    {
        $authorNameFilter = request()->input('filter.author');
        $bookTitleFilter = request()->input('filter.title');
        $topFilter = request()->integer('filter.top');
        if (isset($authorNameFilter)) {
            $builder->whereHas('authors', function (Builder $builder) use ($authorNameFilter) {
                $builder->where('full_name', 'like', '%' . $authorNameFilter . '%');
            });
        }
        if (isset($bookTitleFilter)) {
            $builder->where('title', 'like', '%' . $bookTitleFilter . '%');
        }
        if (!empty($topFilter)) {
            $builder->limit($topFilter);
        }
    }
}
