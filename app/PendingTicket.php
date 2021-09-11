<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendingTicket extends Ticket
{
    use HasFactory;
    protected $table = 'tickets';

    protected static function booted()
    {
        static::addGlobalScope('pending-ticket', function (Builder $builder) {
            $builder->where('status', 'pending');
        });
    }
}
