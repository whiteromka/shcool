<?php

namespace App\Services\OAuth\Yandex;

interface YandexOAuthClientInterface
{
    public function exchangeCodeForToken(string $code): YandexTokenDTO;

    public function fetchUser(string $accessToken): YandexUserDTO;
}
