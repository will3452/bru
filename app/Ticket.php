<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function getUniqIdAttribute(){
        return "BRU".Str::padleft($this->id, 6, '0');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getWorkTypeAttribute(){
        $prt = explode('\\', $this->ticketable_type);
        $end = end($prt);

        if($end == 'Thrailer'){
            $end = 'Trailer / Film / Animation';
        }else if($end == 'Audio'){
            $end = 'Audio Book';
        }else if($end == 'Chapter'){
            if($this->ticketable != null && $this->ticketable->mode != 'chapter'){
                $end = $this->ticketable->mode;
            }else if($this->ticketable != null && $this->ticketable->mode == 'chapter'){
                $end == 'Chapter';
            }else {
                $end = 'Proluge / Epilogue';
            }
        }
        return $end;
    }
}
