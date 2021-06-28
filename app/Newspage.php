<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspage extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function newspaper(){
        return $this->belongsTo(Newspaper::class, 'newspaper_id');
    }
}
