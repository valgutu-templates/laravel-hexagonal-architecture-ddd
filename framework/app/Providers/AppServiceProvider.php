<?php

namespace App\Providers;

use App\ApplicationName\DataStore\User\Application\RegisterUserCommand;
use App\ApplicationName\DataStore\User\Application\RegisterUserCommandHandler;
use App\ApplicationName\Shared\CommandBus\Application\SimpleCommandBus;
use App\ApplicationName\Shared\CommandBus\Domain\CommandBus;
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
        $this->app->singleton(CommandBus::class, function() {
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
