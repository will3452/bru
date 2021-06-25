<?php

namespace App;

use App\Traits\WorkCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory, WorkCountable;
    protected $guarded  = [];

    public function arts(){
        return $this->morphedByMany(Art::class, 'albumable');
    }
    public function songs(){
        return $this->morphedByMany(Song::class, 'albumable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function totalNumberOfWork(){
        return $this->type == 'song' ? $this->songs()->count() : $this->arts()->count();
    }
    
}
