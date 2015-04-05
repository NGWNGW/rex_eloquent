<?php

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
        return $this->belongsTo('Testclass', 're_id');
    }

    public function children() {
        return $this->hasMany('Testclass', 're_id');
    }
}