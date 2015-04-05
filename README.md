Eloquent (Illuminate Database) AddOn für REDAXO 4
============================

The Illuminate Database component is a full database toolkit for PHP, providing an expressive query builder, ActiveRecord style ORM, and schema builder.

Features
--------

* Query Builder / Schema Builder / Eloquent ORM
* Insert / Update / Delete
* Soft deleting
* Date Mutators / Carbon
* Query Scopes
* Event listener
* Eager loading
* Accessors / Mutators
* Array / JSON conversion
* Pagination
* and many more...


Eloquent ORM example (Testclass)
-------------

```php
<?php
// put this into ADDONDIR/models/Testmodel.php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Testmodel extends Eloquent {
    use Sg\Paginator\PaginatorTrait;
    protected $pageVariable = 'seite';

	protected $table = 'rex_article';
    const CREATED_AT = 'createdate';
    const UPDATED_AT = 'updatedate';
	protected $dates = ['createdate', 'updatedate'];

    // needed if unix timestamp
    protected function getDateFormat()
    {
        return 'U';
    }

    // model events
    public static function boot()
    {
        parent::boot();
        static::created(function($obj)
        {

        });
        static::updated(function($obj)
        {

        });
        static::saved(function($obj)
        {

        });
        static::deleted(function($obj)
        {

        });
    }

    public function parent() {
        return $this->belongsTo('Testmodel', 're_id');
    }

    public function children() {
        return $this->hasMany('Testmodel', 're_id');
    }
}
```

Dump Composer autoload
-------------
New classes need to be loaded by Composer
```bash
# open addon directory via console and enter:
php composer.phar dumpautoload
```

Or edit autoload_classmap.php with editor:
```php
vendor/coposer/autoload_classmap.php
```

Output Eloquent ORM (Testmodel)
-------------
```php
<?php

$item = Testmodel::first();

print $item->name;
print $item->createdate->format('d.m.Y');

// or

$items = Testmodel::where('status', 1)->orderBy('updatedate', 'desc')->take(5)->get();

foreach($items as $item) {
    print $item->name;
    print $item->updatedate->format('d.m.Y');

    if($item->children!=null) {
        foreach($item->children as $child) {
            print $child->name;
            print $child->updatedate->format('d.m.Y');
        }
    }
}

```

Output Eloquent ORM with pagination (Testmodel)
-------------
```php
<?php

$items = Testmodel::where('status', 1)->orderBy('updatedate', 'desc')->paginate(5);

foreach($items as $item) {
    print $item->name;
    print $item->updatedate->format('d.m.Y');
}

// Pagination
print $items->links();
```


Credits
-------
* [paginator](https://github.com/joseph-montanez/paginator) Standalone-Wrapper by Joseph Montanez
* [illuminate/database](https://github.com/illuminate/database) Class by Taylor Otwel
* [Babelfish](https://github.com/RexDude/babelfish) AddOn by RexDude
* [Parsedown](http://parsedown.org/) Class by Emanuil Rusev
