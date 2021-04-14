<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsToMany(User::class);
    }

    
    public function  recommendation(){
        return $this->morphOne(Recommendation::class, 'recommendationable');
    }

    //static 
    public static function GETPUBLISHED(){
        return self::whereNotNull('publish_date')->get();
    }
    
    //tickets that will send to the administrator to edit the book.
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }
}
