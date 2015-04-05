<?php namespace Sg\Paginator;

class Paginator extends \Illuminate\Pagination\Paginator {

    /**
     * Create a new Paginator instance.
     *
     * @param  array  $items
     * @param  int    $total
     * @param  int    $perPage
     * @param  int    $page
     * @return void
     */
    public function __construct(array $items, $total, $perPage, $page, $pageName)
    {
        $this->items = $items;
        $this->total = (int) $total;
        $this->perPage = (int) $perPage;
        $this->currentPage = (int) $page;
        $this->pageName = $pageName;
    }


    /**
     * Calculate the current and last pages for this instance.
     *
     * @return void
     */
    protected function calculateCurrentAndLastPages()
    {
        $this->lastPage = (int) ceil($this->total / $this->perPage);
    }

    /**
     * Get the pagination links view.
     *
     * @param  string  $view
     * @return \Illuminate\View\View
     */
    public function links($view = null)
    {
        $paginator = $this;
        ob_start();

        if (isset($view))
        {
            include $view;
        }
        else
        {
            include 'views/bootstrap-3.php';
        }

        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

    /**
     * Get a URL for a given page number.
     *
     * @param  int     $page
     * @return string
     */
    public function getUrl($page)
    {
        $parameters = array(
            $this->pageName => $page,
        );

        // If we have any extra query string key / value pairs that need to be added
        // onto the URL, we will put them in query string form and then attach it
        // to the URL. This allows for extra information like sortings storage.
        if (count($this->query) > 0)
        {
            $parameters = array_merge($parameters, $this->query);
        }

        $fragment = $this->buildFragment();

        return rex_getUrl().'?'.http_build_query($parameters, null, '&').$fragment;
    }

}