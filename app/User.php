<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','role', 'aan_id','picture','vip'
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

    public function getCollegeAttribute(){
        return $this->interests()->where('type', 'college')->first()->name ?? '';
    }

    /**
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function aan(){
        return $this->belongsTo(AAN::class, 'aan_id');
    }

    public function pens(){
        return $this->hasMany(Pen::class, 'user_id');
    }

    public function bio(){
        return $this->hasOne(Bio::class, 'user_id');
    }

    public function interests(){
        return $this->hasMany(Interest::class, 'user_id');
    }

    
    public function books(){
        return $this->hasMany(Book::class);
    }

    public function arts(){
        return $this->hasMany(Art::class);
    }

    public function thrailers(){
        return $this->hasMany(Thrailer::class);
    }


    public function events(){
        return $this->morphMany(Event::class, 'eventable');
    }

    public function audio(){
        return $this->hasMany(Audio::class);
    }

    public function songs(){
        return $this->hasMany(Song::class);
    }

    public function messages(){
        return $this->morphMany(Message::class, 'messagable');
    }

    public function outboxes(){
        return $this->morphMany(Outbox::class, 'outboxable');
    }

    public function inboxes(){
        return $this->hasMany(Message::class, 'to_id');
    }

    public function getUnreadMessagesAttribute(){
        return auth()->user()->inboxes()->whereNull('read_at')->get();
    }

    public function createGroups(){
        return $this->hasMany(Group::class,'creator_id');
    }

    public function groups(){
        return $this->belongsToMany(Group::class)->withPivot('title');
    }

    public function getApprovedGroupsAttribute(){
        return $this->groups()->whereNotNull('approved');
    }

}
