<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\EventServiceProvider;

return [
    AppServiceProvider::class,
    EventServiceProvider::class,
    AuthServiceProvider::class,
];
