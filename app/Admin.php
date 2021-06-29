<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if (is_null($this->last_name)) {
            return "{$this->first_name}";
        }

        return "{$this->first_name} {$this->last_name}";
    }

    public function allowed($role){
        
        if($this->type == 'super admin' || count($this->roles()->where('name', $role)->get()) != 0) return true;
        return false;
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function aans(){
        return $this->hasMany(AAN::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function inboxes(){
        return  $this->hasMany(Message::class, 'admin_receiver_id');
    }

    public function outboxes(){
        return  $this->hasMany(Message::class, 'admin_sender_id');
    }

    public function getUnreadMessagesAttribute(){
        return $this->inboxes()->whereNull('read_at')->get();
    }

    public function events(){
        return $this->morphMany(Event::class, 'eventable');
    }
}
