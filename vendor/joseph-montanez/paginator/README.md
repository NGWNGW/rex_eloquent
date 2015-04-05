paginator
=========

A spoof of the Laravel Paginator to enable it working as a standalone version.

#### Usage

```
class Post extends Eloquent {

    use Sg/Paginator/PaginatorTrait;

    // Optional - custom page name (defaults to page)
    protected $pageVariable = 'page';

}
```

And that's it. From then on you can call the `paginate()` method on this Eloquent model.

#### Todo

- Currently only array access is possible, working on accessing properties as an object