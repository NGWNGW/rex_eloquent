<?php namespace Sg\Paginator;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as OriginalQueryBuilder;

class EloquentBuilder extends Builder
{

    /**
     * Create a new Eloquent query builder instance.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string $pageVariable
     * @return void
     */
    public function __construct(OriginalQueryBuilder $query, $pageVariable = 'page')
    {
        parent::__construct($query);
        $this->pageVariable = $pageVariable;
    }

    /**
     * Get a paginator for the "select" statement.
     *
     * @param  int    $perPage
     * @param  array  $columns
     */
    public function paginate($perPage = null, $columns = array('*'))
    {
        // Figure out the current page
        $total = $this->query->getPaginationCount();

        // Once we have the paginator we need to set the limit and offset values for
        // the query so we can get the properly paginated items. Once we have an
        // array of items we can create the paginator instances for the items.
        $page = isset($_GET[$this->pageVariable]) ? $_GET[$this->pageVariable] : 1;

        $this->query->forPage($page, $perPage);
        
        $items = $this->get($columns)->all();

        $paginator = new Paginator($items, $total, $perPage, $page, $this->pageVariable);
        $paginator->setupPaginationContext();

        return $paginator;
    }

}
