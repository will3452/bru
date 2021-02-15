<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thrailer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'title', 'author', 'video', 'cost', 'gem'];
    
    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function cpy(){
        return $this->morphOne(Cpy::class, 'cpiable');
    }

    
    
}
