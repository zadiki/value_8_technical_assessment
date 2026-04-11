<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // send an email confirmation email to the user passed in the event

        if (config('app.env') === 'local') {
            Log::info('email sent to', [$event->user->email]);
        } else {

            Mail::raw("Welcome {$event->user->name}!", function ($message) use ($event) {
                $message->to($event->user->email)
                    ->subject('Welcome to Our App please confirm your email by clicking the link below!');
            });
        }

    }
}
