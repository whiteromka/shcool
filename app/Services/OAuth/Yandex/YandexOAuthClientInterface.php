<?php

namespace App\Services\OAuth\Yandex;

use App\DTO\OAuth\Yandex\YandexTokenDTO;
use App\DTO\OAuth\Yandex\YandexUserDTO;

interface YandexOAuthClientInterface
{
    public function exchangeCodeForToken(string $code): YandexTokenDTO;

    public function fetchUser(string $accessToken): YandexUserDTO;
}
