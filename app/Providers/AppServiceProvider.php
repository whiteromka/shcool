<?php

namespace App\Providers;

use App\Services\OAuth\Github\GithubOAuthClient;
use App\Services\OAuth\OAuthClientInterface;
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

        $this->app->bind(
            OAuthClientInterface::class,
            GithubOAuthClient::class
        );

        //         $this->app->when(GithubAuthService::class)
        //            ->needs(OAuthClientInterface::class)
        //            ->give(GithubOAuthClient::class);
        //
        //        $this->app->when(YandexAuthService::class)
        //            ->needs(OAuthClientInterface::class)
        //            ->give(YandexOAuthClient::class);
        //    }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
