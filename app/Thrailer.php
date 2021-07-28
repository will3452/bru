<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thrailer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    
    public function user(){
        return $this->belongsToMany(User::class);
    }


    public function  recommendation(){
        return $this->morphOne(Recommendation::class, 'recommendationable');
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }
    
     //static 
     public static function GETPUBLISHED(){
        return self::whereNotNull('approved')->get();
    }

    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    public function series()
    {
        return $this->morphToMany(Series::class, 'seriesable');
    }

    public function collections()
    {
        return $this->morphToMany(Collection::class, 'collectionable');
    }

    public function boxes(){
        return $this->morphToMany(Box::class, 'boxable');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
     public function likes(){
        return $this->morphMany(Like::class, 'likeable');
    }
    
}
