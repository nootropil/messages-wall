<?php

namespace App\Application\Providers;

use Illuminate\Support\ServiceProvider;
use App\Application\Services\User\RegistrationService;
use App\Domain\Services\Message\MessageServiceInterface;
use App\Domain\Services\User\RegistrationServiceInterface;
use App\Application\Services\Message\MessageService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Message */
        $this->app->bind(MessageServiceInterface::class,MessageService::class);
        /* User */
        $this->app->bind(RegistrationServiceInterface::class,RegistrationService::class);
    }
}
