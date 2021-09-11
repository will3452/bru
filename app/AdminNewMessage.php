<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminNewMessage extends Message
{
    use HasFactory;
    protected $table = 'messages';

    protected static function booted()
    {
        static::addGlobalScope('admin-messages', function (Builder $builder) {
            $builder->whereNotNull('admin_receiver_id')->whereNull('read_at');
        });
    }
}
