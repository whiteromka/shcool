<?php

namespace App\Services\OAuth;

use Illuminate\Support\Carbon;
use RuntimeException;

class OAuthTokensDTO
{
    public function __construct(
        public readonly string $accessToken,
        public readonly ?string $refreshToken,
        public readonly ?Carbon $expiresAt,
        public readonly ?Carbon $refreshTokenExpiresAt,
        public readonly ?string $tokenType,
        public readonly ?string $scope,
        public readonly array $raw
    ) {}

    /**
     * @param array $data
     * @param string $serviceName Например: "Яндекс OAuth" или "Google OAuth"
     * @return self
     */
    public static function fromArray(array $data, string $serviceName = 'OAuth service'): self
    {
        if (empty($data['access_token'])) {
            throw new RuntimeException($serviceName . ' сервис не смог вернуть access_token');
        }
        if (empty($data['refresh_token'])) {
            throw new RuntimeException($serviceName . ' сервис не смог вернуть refresh_token');
        }
        if (empty($data['expires_in'])) {
            throw new RuntimeException($serviceName . ' сервис не смог вернуть expires_in');
        }
//        if (!is_numeric($data['expires_in'])) {
//            throw new RuntimeException($serviceName . ' сервис вернул expires_in не как numeric');
//        }
//        if (!is_numeric($data['refresh_token_expires_in'])) {
//            throw new RuntimeException($serviceName . ' сервис вернул refresh_token_expires_in не как numeric');
//        }

        return new self(
            accessToken: $data['access_token'],
            refreshToken: $data['refresh_token'] ?? null,
            expiresAt: $data['expires_in'] ? now()->addSeconds($data['expires_in']) : null,
            refreshTokenExpiresAt: $data['refresh_token_expires_in'] ? now()->addSeconds($data['refresh_token_expires_in']): null,
            tokenType: $data['token_type'] ?? null,
            scope: $data['scope'] ?? null,
            raw: $data
        );
    }
}
