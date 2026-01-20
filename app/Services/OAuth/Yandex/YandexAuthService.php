<?php

namespace App\Services\OAuth\Yandex;

use App\Enums\OAuthProvider;
use App\Services\OAuth\OAuthClientInterface;
use App\Services\OAuth\OAuthServiceInterface;
use App\Services\OauthAccountService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class YandexAuthService implements OAuthServiceInterface
{
    public function __construct(
        private readonly OAuthClientInterface $oauthClient,
        private readonly UserService $userService,
        private readonly OauthAccountService $oauthAccountService,
    ) {}

    public function authenticate(string $code): void
    {
        $oauthTokensDTO = $this->oauthClient->exchangeCodeForToken($code);
        $oauthUserDTO = $this->oauthClient->fetchUser($oauthTokensDTO->access_token);

        $user = $this->userService->findOrCreateByEmail($oauthUserDTO);

        $attributes = $oauthTokensDTO->attributes();
        $attributes['user_id'] = $user->id;

        $this->oauthAccountService->updateOrCreate(
            OAuthProvider::YANDEX->value,
            $oauthUserDTO->id,
            $attributes
        );

        Auth::login($user);
        request()->session()->regenerate();
    }
}
