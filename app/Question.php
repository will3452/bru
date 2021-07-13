<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function getArrayAnswerAttribute(){
        $arr = [];
       foreach( explode('**', $this->answers) as $str){
           array_push($arr, trim($str));
       }
       return $arr;
    }
}
