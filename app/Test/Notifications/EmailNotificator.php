<?php

namespace App\Test\Notifications;

use App\Models\User;

class EmailNotificator implements NotificatorInterface
{
    public function notify(User $user, string $message): void
    {
        //1. из пользователя узнаем его имейл
        $user->email;
        //2. узнать из приложения имейл отправителя
        //3. вызвать функцию отправки от кого, кому, какой текст
        echo "email sent to user A, their email box B, with content C" . "<br>";
    }
}
