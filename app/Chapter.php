<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getOpathAttribute(){
        $arr_path = explode('/', $this->art);
        $end_path = end($arr_path);
        return '/public/arts/'.$end_path;
    }

    public function getOcontentAttribute(){
        $arr_path = explode('/', $this->content);
        $end_path = end($arr_path);
        return '/public/chapter_content/'.$end_path;
    }

    public function getRouteKeyName(){
        return 'id';
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    //tickets that will send to the administrator to edit the book.
    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }
    

    
}
