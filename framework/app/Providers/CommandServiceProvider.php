<?php

namespace App\Providers;

use App\ApplicationName\Authentication\Domain\CreateAccessTokenCommand;
use App\ApplicationName\Authentication\Domain\GetUserCommand;
use App\ApplicationName\Authentication\Infrastructure\DataStoreCreateAccessTokenCommand;
use App\ApplicationName\Authentication\Infrastructure\DataStoreGetUserCommand;
use App\ApplicationName\Registration\Domain\CreateUserCommand;
use App\ApplicationName\Registration\Infrastructure\DataStoreCreateUserCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CreateUserCommand::class, DataStoreCreateUserCommand::class);
        $this->app->bind(CreateAccessTokenCommand::class, DataStoreCreateAccessTokenCommand::class);
        $this->app->bind(GetUserCommand::class, DataStoreGetUserCommand::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
