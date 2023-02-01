<?php

namespace App\Providers;

use App\ApplicationName\DataStore\User\Application\RegisterUserCommand;
use App\ApplicationName\DataStore\User\Application\RegisterUserCommandHandler;
use App\ApplicationName\Shared\Application\SimpleCommandBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SimpleCommandBus::class, function() {
            $commandBus = new SimpleCommandBus();
            $commandBus->registerHandler(RegisterUserCommand::class, app(RegisterUserCommandHandler::class));

            return $commandBus;
        });
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
