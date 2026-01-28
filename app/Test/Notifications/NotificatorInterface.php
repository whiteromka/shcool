<?php

namespace App\Test\Notifications;

use App\Models\User;

interface NotificatorInterface
{
    public function notify(User $user, string $message): void;
}
