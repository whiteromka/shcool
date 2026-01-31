<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findOrCreateByEmail(string $email, array $attributes): User
    {
        return User::query()->firstOrCreate(
            ['email' => $email],
            $attributes
        );
    }

    /**
     * @param string $tgId Пример: 152365734
     * @param array $attributes
     * @return User
     */
    public function findOrCreateByTelegramId(string $tgId, array $attributes): User
    {
        return User::query()->firstOrCreate(
            ['telegram_id' => $tgId],
            $attributes
        );
    }

    /**
     * @param string $telegram Пример: @rom_1989
     * @param array $attributes
     * @return User
     */
    public function findOrCreateByTelegram(string $telegram, array $attributes): User
    {
        return User::query()->firstOrCreate(
            ['telegram' => $telegram],
            $attributes
        );
    }

    public function findWhere(string $column, $value): ?User
    {
        return User::query()->where('email', 'john@example.com')->first();
    }

    public function create(array $attributes): User
    {
        return User::query()->create($attributes);
    }
}
