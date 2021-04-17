<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function members(){
        return $this->belongsToMany(User::class);
    }

    public function thrailers(){
        #this is for trailers, films , and animation 
        return $this->hasMany(Thrailer::class);
    }

    //count of total works
    public function getNumberOfWorksAttribute(){
        $total = 0;
        $total+= $this->thrailers()->count();
        return $total;
    }

    public static function APPROVED(){
        return self::whereNotNull('approved')->get();
    }


    public static function UNAPPROVED(){
        return self::whereNull('approved')->get();
    }
}
