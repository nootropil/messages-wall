<?php

namespace App\Application\Providers;

use App\Domain\Repositories\Message\MessageReadRepository;
use App\Domain\Repositories\Message\MessageRepository;
use App\Domain\Repositories\User\UserReadRepository;
use App\Domain\Repositories\User\UserRepository;

use App\Infrastructure\Repositories\Message\LaravelSqlMessageReadRepository;
use App\Infrastructure\Repositories\Message\LaravelSqlMessageRepository;
use App\Infrastructure\Repositories\User\LaravelSqlUserReadRepository;
use App\Infrastructure\Repositories\User\LaravelSqlUserRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(MessageReadRepository::class,LaravelSqlMessageReadRepository::class);
        $this->app->bind(MessageRepository::class,LaravelSqlMessageRepository::class);
        /* User */
        $this->app->bind(UserReadRepository::class,LaravelSqlUserReadRepository::class);
        $this->app->bind(UserRepository::class,LaravelSqlUserRepository::class);

    }
}
