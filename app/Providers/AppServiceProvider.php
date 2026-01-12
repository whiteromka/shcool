<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OAuth\Yandex\YandexOAuthClient;
use App\Services\OAuth\Yandex\YandexOAuthClientInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            YandexOAuthClientInterface::class,
            YandexOAuthClient::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
