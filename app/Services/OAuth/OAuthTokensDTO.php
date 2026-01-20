<?php

namespace App\Services\OAuth;

use Illuminate\Support\Carbon;
use RuntimeException;

class OAuthTokensDTO
{
    public function __construct(
        public readonly string $access_token,
        public readonly ?string $refresh_token,
        public readonly ?Carbon $expires_at,
        public readonly ?Carbon $refresh_token_expires_at,
        public readonly ?string $token_type,
        public readonly ?string $scope,
        public readonly ?array $raw_response
    ) {}

    /**
     * @param array $data Токены и их время жизни
     * @param string $serviceName Например: "Яндекс OAuth" или "Google OAuth"
     * @return self
     */
    public static function fromArray(array $data, string $serviceName = 'OAuth service'): self
    {
        if (empty($data['access_token'])) {
            throw new RuntimeException($serviceName . ' сервис не смог вернуть access_token');
        }

        $expiresIn = $data['expires_in'] ?? null;
        $expiresAt = is_numeric($expiresIn) ? now()->addSeconds((int)$expiresIn) : null;
        $refreshTokenExpiresIn = $data['refresh_token_expires_in'] ?? null;
        $refreshTokenExpiresAt = is_numeric($refreshTokenExpiresIn) ? now()->addSeconds((int)$refreshTokenExpiresIn) : null;

        return new self(
            access_token: $data['access_token'],
            refresh_token: $data['refresh_token'] ?? null,
            expires_at: $expiresAt,
            refresh_token_expires_at: $refreshTokenExpiresAt,
            token_type: $data['token_type'] ?? null,
            scope: $data['scope'] ?? null,
            raw_response: $data
        );
    }

    public function attributes(): array
    {
        return get_object_vars($this);
    }
}
