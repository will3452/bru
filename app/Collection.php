<?php

namespace App;

use App\Traits\WorkCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory, WorkCountable;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function books(){
        return $this->morphedByMany(Book::class, 'collectionable');
   }

   public function audios(){
        return $this->morphedByMany(Audio::class, 'collectionable');
   }

   public function films(){
        return $this->morphedByMany(Thrailer::class, 'collectionable');
   }

   public function podcasts(){
        return $this->morphedByMany(Podcast::class, 'collectionable');
    }
    public function arts(){
        return $this->morphedByMany(Art::class, 'collectionable');
    }
    public function songs(){
        return $this->morphedByMany(Song::class, 'collectionable');
    }

    // traits 
    public function totalNumberOfWork(){
        return $this->books()->count() + $this->audios()->count() + $this->films()->count() + $this->podcasts()->count() + $this->arts()->count() + $this->songs()->count();
        // return count();
        // dd($this->collectionable);
    }


   
}
