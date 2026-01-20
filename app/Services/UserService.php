<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\OAuth\OAuthUserDTO;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordGeneratorService $passwordGeneratorService
    ) {}

    public function findOrCreateByEmail(OAuthUserDTO $dto): User
    {
        $attributes = $dto->attributes();
        // Внешние OAuth сервисы не отдают пароль, создадим его, что бы пользователя можно было сохранить в БД
        $attributes['password'] = $this->passwordGeneratorService->generateRandomPassword();

        return $this->userRepository->findOrCreateByEmail($dto->email, $attributes);
    }
}
