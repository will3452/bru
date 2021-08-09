<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getUidAttribute()
    {
        return Str::padleft($this->id, 7, '0');
    }

    public function boxes()
    {
        return $this->morphToMany(Box::class, 'boxable');
    }

}
