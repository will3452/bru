<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function books(){
        return $this->morphedByMany(Book::class, 'taggable')->withTimestamps();
    }

    public function arts(){
        return $this->morphedByMany(Art::class, 'taggable')->withTimestamps();
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
