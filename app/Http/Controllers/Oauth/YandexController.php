<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class YandexController extends Controller
{
    // route: http://localhost:8080/yandex/verification-code?code=some_code&cid=xxx
    public function verificationCode(Request $request)
    {
        $code = $request->get('code');
        if (!$code) {
            abort(400, 'Authorization code not found');
        }
        $response = Http::asForm()->post('https://oauth.yandex.ru/token', [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => config('services.yandex.client_id'),
            'client_secret' => config('services.yandex.client_secret'),
        ]);

        if ($response->failed()) {
            logger()->error('Yandex OAuth error', $response->json()); // [2026-01-09 21:15:17] local.ERROR: Yandex OAuth error {"error":"invalid_grant","error_description":"Code has expired"}
            abort(500, 'Yandex OAuth failed');
        }

        $data = $response->json();
        return $data; // временно для отладки
//      $data =
//         {
//          "access_token": "aaa",
//          "expires_in": 31536000, // $expiresAt = now()->addSeconds(31536000); // 1 год
//          "refresh_token": "bbb",
//          "token_type": "bearer"
//        }

    }
}
