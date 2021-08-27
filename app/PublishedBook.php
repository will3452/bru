<?php

namespace App;

use App\Book;
use App\Scopes\PublishBookScope;

class PublishedBook extends Book
{
    protected $table = 'books';

    protected static function booted()
    {
        static::addGlobalScope(new PublishBookScope);
    }
}
