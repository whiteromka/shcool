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

    public function create(array $attributes): User
    {
        return User::query()->create($attributes);
    }
}
