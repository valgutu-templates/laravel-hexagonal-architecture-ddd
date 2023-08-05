<?php

namespace App\Providers;

use App\ApplicationName\DataStore\AccessToken\Domain\AccessTokenRepository;
use App\ApplicationName\DataStore\AccessToken\Infrastructure\EloquentAccessTokenRepository;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\EmailVerificationCodeRepository;
use App\ApplicationName\DataStore\EmailVerificationCode\Infrastructure\EloquentEmailEmailVerificationCodeRepository;
use App\ApplicationName\DataStore\Role\Domain\RoleRepository;
use App\ApplicationName\DataStore\User\Domain\UserRepository;
use App\ApplicationName\DataStore\Role\Infrastructure\EloquentRoleRepository;
use App\ApplicationName\DataStore\User\Infrastructure\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(RoleRepository::class, EloquentRoleRepository::class);
        $this->app->bind(AccessTokenRepository::class, EloquentAccessTokenRepository::class);
        $this->app->bind(EmailVerificationCodeRepository::class, EloquentEmailEmailVerificationCodeRepository::class);
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
