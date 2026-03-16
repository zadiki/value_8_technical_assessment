<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            Log::info("email sent to",[$event->user->email]);
          }
    }
}
