<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->greeting('Hello '.$notifiable->full_name.'!')
                ->line("Thank you for creating an account with us! We are excited to show you what our multiverse has. You only need to accomplish one more step to finish your registration, and you're on your way to experiencing amazing journeys. ")
                ->line("Please click the button below to verify your email address.")
                ->action('Verify Email Address', $url)
                ->line('If you did not create an account, no further action is required.');
        });
    }
}
