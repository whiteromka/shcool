<?php

namespace App\Services\OAuth;

interface OAuthClientInterface
{
    public function exchangeCodeForToken(string $code): OAuthTokensDTO;

    public function fetchUser(string $accessToken): OAuthUserDTO;
}
