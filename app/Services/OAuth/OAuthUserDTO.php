<?php

namespace App\Services\OAuth;

use App\Enums\OAuthProvider;
use RuntimeException;

class OAuthUserDTO
{
    public function __construct(
        public string $id,
        public string $email,
        public string $name,
        public ?string $last_name,
        public ?string $username,
        public ?int $email_verified
    ) {}

    /**
     * @param array $data Данные полученные из внешних OAuth сервисов
     * @param string $serviceName Имя внешнего OAuth сервиса
     * @return self
     */
    public static function fromArray(array $data, string $serviceName = 'OAuth service'): self
    {
        $email = strtolower($data['email'] ?? $data['default_email'] ?? $data['emails'][0] ?? '');
        if (!$email) {
            throw new RuntimeException("$serviceName не смог вернуть email пользователя");
        }
        if (empty($data['id'])) {
            throw new RuntimeException("$serviceName не смог вернуть id пользователя");
        }
        $name = $data['first_name'] ?? $data['name'] ?? null;
        if (!$name) {
            throw new RuntimeException("$serviceName не смог вернуть first_name пользователя");
        }

        return new self(
            id: (string)$data['id'],
            email: $email,
            name: $name,
            last_name: $data['last_name'] ?? null,
            username: $data['username'] ?? null,
            email_verified: $data['email_verified'] ?? in_array($serviceName, OAuthProvider::verifiedEmailProviders())
        );
    }

    public function attributes(): array
    {
        return get_object_vars($this);
    }
}
