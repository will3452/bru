<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Art extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'arts';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function  recommendation(){
        return $this->morphOne(Recommendation::class, 'recommendationable');
    }

    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    public static function GETPUBLISHED(){
        return self::get();
    }

    public function collections()
    {
        return $this->morphToMany(Collection::class, 'collectionable');
    }

    public function albums()
    {
        return $this->morphToMany(Album::class, 'albumable');
    }

}
