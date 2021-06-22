<?php

namespace App;

use App\Traits\WorkCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory, WorkCountable;
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

     public function group(){
          return $this->belongsTo(Group::class);
     }

     public function totalNumberOfWork(){
          $total = 0;
          switch($this->type){
               case 'book':
                    $total =  $this->books()->count();
                    break;
               case 'audio book':
                    $total = $this->audios()->count();
                    break;
               case 'podcast':
                    $total = $this->podcasts()->count();
                    break;
               case 'film':
                    $total = $this->films()->count();
                    break;
          }
          return $total;
     }
}
