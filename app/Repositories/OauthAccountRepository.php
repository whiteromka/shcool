<?php

namespace App\Repositories;

use App\Models\OauthAccount;

class OauthAccountRepository
{
    public function updateOrCreate(string $provider, string $providerUserId, array $attributes): OauthAccount
    {
        return OauthAccount::query()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_user_id' => $providerUserId,
            ],
            $attributes
        );
    }
}
