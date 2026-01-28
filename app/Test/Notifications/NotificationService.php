<?php

namespace App\Test\Notifications;

use App\Models\User;

class NotificationService
{
    private NotificatorInterface $notificator;

    public function __construct(NotificatorInterface $notificator)
    {
        $this->notificator = $notificator;
    }

    public function notify(User $user, string $message): void
    {
        $this->notificator->notify($user, $message);
    }
}
