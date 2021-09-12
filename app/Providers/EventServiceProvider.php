<?php

namespace App\Providers;

use App\AAN;
use App\Chapter;
use App\Invoice;
use App\Observers\AANObserver;
use App\Observers\ChapterObserver;
use App\Observers\InvoiceObserver;
use App\Observers\PermissionObserver;
use App\Observers\TicketObserver;
use App\Observers\UserObserver;
use App\Permission;
use App\Ticket;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        User::observe(UserObserver::class);
        Invoice::observe(InvoiceObserver::class);
        AAN::observe(AANObserver::class);
        Permission::observe(PermissionObserver::class);
        Ticket::observe(TicketObserver::class);
        Chapter::observe(ChapterObserver::class);
    }
}
