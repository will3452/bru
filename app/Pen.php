<?php

namespace App;

use App\Art;
use App\Book;
use App\Song;
use App\Audio;
use App\Thrailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pen extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function canDelete(){
        if(Book::where('author',$this->name)->count()) return false;
        if(Audio::where('author',$this->name)->count()) return false;
        if(Art::where('artist', $this->name)->count()) return false;
        if(Song::where('artist', $this->name)->orWhere('composer', $this->name)->orWhere('lyricist')->count()) return false;
        if(Thrailer::where('author', $this->name)->count()) return false;
        return true;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
