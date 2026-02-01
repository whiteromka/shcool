<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TelegramAuthController extends Controller
{
    public function __construct(
        private readonly TelegramService $telegramService,
    ) {}

    // ToDo yна локалке не получилось протестить
    // /telegram-auth/auth
    // [
    //    "id"         => "123456789",        // Telegram user ID (ОБЯЗАТЕЛЬНО)
    //    "first_name" => "Ivan",
    //    "last_name"  => "Ivanov",            // может не быть
    //    "username"   => "ivanov",            // может не быть
    //    "photo_url"  => "https://t.me/i/userpic/320/...",
    //    "auth_date"  => "1706700000",         // unix timestamp
    //    "hash"       => "a8f4c3e9..."         // КРИПТО-подпись (ОБЯЗАТЕЛЬНО)
    //]
    public function auth(Request $request)
    {
        $data = $request->all();

        if (!$this->checkTelegramAuthorization($data)) {
            abort(403, 'Telegram auth failed');
        }

        $tgId = $request->get('id');
        $tgUsername = $request->get('username');
        $tgName = $request->get('first_name');
        $tgLastName =  $request->get('last_name');
        $user = $this->telegramService->createOrUpdateUser($tgId, $tgUsername, $tgName, $tgLastName);
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('user.lk'); // Редирект в ЛК
        }
        return redirect()->route('home');
    }

    private function checkTelegramAuthorization(array $data): bool
    {
        if (!isset($data['hash'], $data['auth_date'])) {
            return false;
        }

        if (time() - (int)$data['auth_date'] > 86400) {
            return false;
        }

        $hash = $data['hash'];
        unset($data['hash']);

        ksort($data);

        $dataCheckString = collect($data)
            ->map(fn ($v, $k) => $k . '=' . (string) $v)
            ->implode("\n");

        $secretKey = hash('sha256', config('services.telegram.bot_token'), true);

        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        return hash_equals($calculatedHash, $hash);
    }
}
