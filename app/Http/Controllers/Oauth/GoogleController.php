<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use App\Models\OauthAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Перенаправление на Google для авторизации
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Обработка callback от Google
     */
    public function verificationCode()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = $this->findOrCreateUser($googleUser);
        Auth::login($user, true);
        return redirect()->intended('/');
    }

    /**
     * Поиск существующего пользователя или создание нового
     */
    private function findOrCreateUser(\Laravel\Socialite\Two\User $googleUser)
    {
        $nameParts = explode(' ', $googleUser->getName(), 2);
        $name = $nameParts[0];
        $lastName = $nameParts[1] ?? null;
        $email = $googleUser->getEmail();
        $googleId = $googleUser->getId();

        // Ищем пользователя по email и создаем его если его нет
        $user = User::query()->firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'last_name' => $lastName,
                'password' => Hash::make(Str::random(32)),
                'password_verified' => 0,
                'email_verified_at' => now(),
            ]
        );

        $expiresIn = $googleUser->expiresIn ?? null;
        $expiresAt = is_numeric($expiresIn) ? now()->addSeconds((int)$expiresIn) : null;
        OauthAccount::query()->updateOrCreate(
            [
                'provider' => OauthAccount::GOOGLE,
                'provider_user_id' => $googleId,
            ],
            [
                'user_id' => $user->id,
                'access_token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'expires_at' => $expiresAt,
                'token_type' => null,
                'scope' => implode('; ', $googleUser->approvedScopes),
                'raw_response' => [],
            ]
        );

        return $user;
    }
}
