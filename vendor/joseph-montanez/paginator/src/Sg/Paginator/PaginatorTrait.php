<?php namespace Sg\Paginator;

use Sg\Paginator\EloquentBuilder;

trait PaginatorTrait {

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Sg\Paginator\EloquentBuilder|static
     */
    public function newEloquentBuilder($query)
    {
        if (isset($this->pageVariable))
            return new EloquentBuilder($query, $this->pageVariable);

        return new EloquentBuilder($query);
    }

}