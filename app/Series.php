<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $guarded = [];

   public function books(){
        return $this->morphedByMany(Book::class, 'seriesable');
   }

   public function audios(){
        return $this->morphedByMany(Audio::class, 'seriesable');
   }

   public function films(){
        return $this->morphedByMany(Thrailer::class, 'seriesable');
   }

   public function podcasts(){
     return $this->morphedByMany(Podcast::class, 'seriesable');
     }
}
