<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Multicaret\Acquaintances\Traits\CanBeFollowed;
use Multicaret\Acquaintances\Traits\CanBeLiked;
use Multicaret\Acquaintances\Traits\CanBeRated;
use Multicaret\Acquaintances\Traits\CanFollow;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\CanRate;
use Multicaret\Acquaintances\Traits\CanSubscribe;
use Multicaret\Acquaintances\Traits\Friendable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;
    use Friendable;
    use CanFollow, CanBeFollowed;
    use CanLike, CanBeLiked;
    use CanRate, CanBeRated;
    use CanSubscribe;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function scopeOther($user)
    {

    }
    public function getCollegeAttribute()
    {
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

    public function aan()
    {
        return $this->belongsTo(AAN::class, 'aan_id');
    }

    public function pens()
    {
        return $this->hasMany(Pen::class, 'user_id');
    }

    public function bio()
    {
        return $this->hasOne(Bio::class, 'user_id');
    }

    public function interests()
    {
        return $this->hasMany(Interest::class, 'user_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function arts()
    {
        return $this->hasMany(Art::class);
    }

    public function thrailers()
    {
        return $this->hasMany(Thrailer::class);
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'eventable');
    }

    public function audio()
    {
        return $this->hasMany(Audio::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    public function createGroups()
    {
        return $this->hasMany(Group::class, 'creator_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->withPivot('title');
    }

    public function getApprovedGroupsAttribute()
    {
        return $this->groups()->whereNotNull('approved');
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function inboxes()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function outboxes()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function getUnreadMessagesAttribute()
    {
        return $this->inboxes()->whereNull('read_at')->get();
    }

    public function series()
    {
        return $this->hasMany(Series::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function royalties()
    {
        return $this->hasOne(Royalty::class, 'user_id');
    }

    public function sharedSeries()
    {
        //books, audio books, film, podcasts
        $shared_series = collect();
        $id = $this->id;

        $no_series = Series::where('user_id', '!=', $this->id)->get();

        foreach ($no_series as $s) {
            if (
                $s->books()->where('user_id', $id)->get() ||
                $s->audios()->where('user_id', $id)->get() ||
                $s->films()->where('user_id', $id)->get() ||
                $s->podcasts()->where('user_id', $id)
            ) {
                $shared_series->push($s);
            }
        }
        return $shared_series->all();
    }

    public function box()
    {
        return $this->hasOne(Box::class, 'user_id');
    }

    public function isArtIsInTheBox($id)
    {

        if ($this->box == null) {
            $this->box()->create([]);
        }

        $box = $this->box->arts()->find($id);

        if ($box) {
            return true;
        }

        return false;
    }

    public function isBookIsInTheBox($id)
    {

        if ($this->box == null) {
            $this->box()->create([]);
        }

        $box = $this->box->books()->find($id);

        if ($box) {
            return true;
        }

        return false;
    }

    public function isFilmIsInTheBox($id)
    {

        if ($this->box == null) {
            $this->box()->create([]);
        }

        $box = $this->box->films()->find($id);

        if ($box) {
            return true;
        }

        return false;
    }
    public function isSongIsInTheBox($id)
    {

        if ($this->box == null) {
            $this->box()->create([]);
        }

        $box = $this->box->songs()->find($id);

        if ($box) {
            return true;
        }

        return false;
    }

    public function isAudioIsInTheBox($id)
    {

        if ($this->box == null) {
            $this->box()->create([]);
        }
        $box = $this->box->audios()->find($id);

        if ($box) {
            return true;
        }

        return false;
    }

    public function isPodcastIsInTheBox($id)
    {

        if ($this->box == null) {
            $this->box()->create([]);
        }

        $box = $this->box->podcasts()->find($id);

        if ($box) {
            return true;
        }

        return false;
    }

    public function markets()
    {
        return $this->hasMany(Market::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function stars()
    {
        return $this->hasMany(Star::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function playlist()
    {
        return $this->hasOne(Playlist::class);
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }

    public function spins()
    {
        return $this->hasMany(Spin::class);
    }

    public function daylogs()
    {
        return $this->hasMany(DayLog::class);
    }

    public function logChecked()
    {
        return $this->hasMany(DateClicked::class);
    }

    public function diaries()
    {
        return $this->hasMany(Diary::class);
    }

    //for diary
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    // public function friends(){
    //     return $this->belongsToMany(User::class, 'friend_user', 'user_id', 'friend_id')->withPivot('status');
    //     // Auth::user()->friends()->attach([2,3,4]);  -- add friend
    //     //Auth::user()->friends (or Auth::user()->friends()->get()) -- get all friends
    //     //Auth::user()->friends()->detach([2]); // Remove user_id = 2
    // }

    // public function getAllFriendsAttribute(){
    //    $usersid =  \DB::table('friend_user')->where(['friend_id'=>$this->id, 'status'=>'accepted'])->orWhere(['user_id'=>$this->id, 'status'=>'accepted'])->get()->pluck('user_id');
    //    return self::whereIn('id', $usersid)->get();
    // }

    public function homework()
    {
        return $this->hasOne(Homework::class);
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
