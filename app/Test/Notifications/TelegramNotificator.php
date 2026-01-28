<?php

namespace App\Test\Notifications;

use App\Models\User;

class TelegramNotificator implements NotificatorInterface
{
    public function notify(User $user, string $message): void
    {
        //1. из пользователя получить tg id
        //2. получить id телеграм бота
        //3. взять айди бота, айди пользователя и сообщение
        echo "tg message sent to user A, with content B, tg id CCC" . "<br>";
    }
}
