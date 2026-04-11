<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\UserRegistered;
use App\Listeners\SendConfirmEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegistered::class => [
            SendConfirmEmail::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
