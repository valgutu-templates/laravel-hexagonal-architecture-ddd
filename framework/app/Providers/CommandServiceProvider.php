<?php

namespace App\Providers;

use App\ApplicationName\Authentication\Domain\CreateAccessTokenCommand;
use App\ApplicationName\Authentication\Domain\GetUserCommand;
use App\ApplicationName\Authentication\Infrastructure\DataStoreCreateAccessTokenCommand;
use App\ApplicationName\Authentication\Infrastructure\DataStoreGetUserCommand;
use App\ApplicationName\DashboardServer\AccountVerification\Domain\CreateEmailVerificationCodeCommand;
use App\ApplicationName\DashboardServer\AccountVerification\Domain\SendVerificationEmailCommand;
use App\ApplicationName\DashboardServer\AccountVerification\Infrastructure\DataStoreCreateEmailVerificationCodeCommand;
use App\ApplicationName\DashboardServer\AccountVerification\Infrastructure\MailingSendVerificationEmailCommand;
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
        $this->app->bind(CreateEmailVerificationCodeCommand::class, DataStoreCreateEmailVerificationCodeCommand::class);
        $this->app->bind(SendVerificationEmailCommand::class, MailingSendVerificationEmailCommand::class);
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
