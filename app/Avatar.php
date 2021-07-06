<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
