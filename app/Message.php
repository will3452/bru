<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const DAYDELETE = 30;

    use HasFactory;

    protected $guarded = [];
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function admin_sender()
    {
        return $this->belongsTo(Admin::class, 'admin_sender_id');
    }

    public function admin_receiver()
    {
        return $this->belongsTo(Admin::class, 'admin_receiver_id');
    }

    public function getRepliesAttribute()
    {
        return self::where('reply_id', $this->id)->get();
    }

}
