<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordGeneratorService
{
    public function generateRandomPassword(): string
    {
        return Hash::make(Str::random(32));
    }

    public function hash(string $password): string
    {
        return Hash::make($password);
    }
}
