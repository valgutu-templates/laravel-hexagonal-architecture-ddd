<?php

namespace App\Providers;

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
