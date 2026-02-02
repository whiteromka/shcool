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

    // ToDo на локалке не получилось протестить
    // /telegram-auth/auth
    // [
    //    "id"         => "123456789",        // Telegram user ID (ОБЯЗАТЕЛЬНО)
    //    "first_name" => "Ivan",
    //    "last_name"  => "Ivanov",            // может не быть
    //    "username"   => "ivanov",            // может не быть
    //    "auth_date"  => "1706700000",         // unix timestamp
    //    "hash"       => "a8f4c3e9..."         // КРИПТО-подпись (ОБЯЗАТЕЛЬНО)
    //]
    public function auth(Request $request)
    {
        $data = $request->all();
        if (!$this->telegramService->checkHash($data)) {
            abort(403, 'Telegram auth failed');
        }
        $attributes['telegram_id'] = $request->get('id', '');
        $attributes['telegram'] = $request->get('username', '');
        $attributes['name'] = $request->get('first_name', '');
        $attributes['last_name'] = $request->get('last_name', '');

        $user = $this->telegramService->createOrUpdateUser($attributes);
        if ($user) {
            Auth::login($user, true);
            return redirect()->route('user.lk'); // Редирект в ЛК
        }
        return redirect()->route('home');
    }

}
