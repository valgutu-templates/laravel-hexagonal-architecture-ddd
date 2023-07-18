<?php

namespace App\Providers;

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
