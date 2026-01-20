<?php

namespace App\Services;

use App\Models\OauthAccount;
use App\Repositories\OauthAccountRepository;

class OauthAccountService
{
    public function __construct(
        private readonly OauthAccountRepository $oauthAccountRepository
    ) {}

    public function updateOrCreate(string $provider, string $providerUserId, array $attributes): OauthAccount
    {
        return $this->oauthAccountRepository->updateOrCreate($provider, $providerUserId, $attributes);
    }
}
