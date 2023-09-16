<?php

namespace App\Providers;

use App\ApplicationName\Mailing\Domain\MailProcessor;
use App\ApplicationName\Mailing\Infrastructure\LaravelMailProcessor;
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
        $this->app->bind(MailProcessor::class, LaravelMailProcessor::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
