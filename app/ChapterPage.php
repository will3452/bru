<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChapterPage extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function chapter()
    {
        return $this->hasMany(Chapter::class);
    }
}
