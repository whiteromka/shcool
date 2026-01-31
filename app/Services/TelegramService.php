<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EmailGeneratorService $emailGeneratorService,
        private readonly PasswordGeneratorService $passwordGeneratorService
    )
    {}

    /**
     * Приветственное сообщение
     */
    public function sayHello(array $data): void
    {
        $telegramId = $data['message']['from']['id'] ?? '';
        $telegramUsername = $data['message']['from']['username'] ?? '';
        $firstName = $data['message']['from']['first_name'] ?? '';
        $lastName = $data['message']['from']['last_name'] ?? '';

        if (!$telegramId && !$telegramUsername) {
            return;
        }

        // 1. Сохраняем в базу
        $this->createOrUpdateUser($telegramId, $telegramUsername, $firstName, $lastName);

        // 2. Уведомляем себя (опционально)
        // ...->notifyAdmin($telegramId, $telegramUsername);

        // 3. Отправляем ответ пользователю
        $name = $telegramUsername ? "@{$telegramUsername}" : $firstName;
        $message = "Привет, {$name}!\n\n";
        $message .= "Ваш Telegram ID: <code>{$telegramId}</code>\n\n";
        $message .= "Уведомлю Вас когда группа на курс на который Вы записаны собралась и когда откроется оплата курса!\n";
        $message .= "Используйте эти команды если хотите что бы я что-то уточнил: ...(это опционально не уверен что это нужно) \n\n";
        $message .= "ToDo: Когда придет время действительно уведомить пол-ля о том что оплата курса разблокирована и можно оплачивать.";

        $this->sendToUser($telegramId, $message);
    }

    /**
     * Отправить в общий чат
     */
    public function sendToCommonChat(string $text): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id'); // ID общего чата куда добавили бота
        // $chatId = config('services.telegram.my_id'); // мой ID

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        } catch (Exception $e) {
            Log::error('Error TelegramService::sendMessage(). ' . $e->getMessage());
        }
    }

    /**
     * Отправить конкретному пользователю
     */
    public function sendToUser(string $userId, string $text): void
    {
        $token = config('services.telegram.bot_token');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $userId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        } catch (Exception $e) {
            Log::error('Error TelegramService::sendToUser(). ' . $e->getMessage());
        }
    }

    /**
     * @param string $telegramId
     * @param string $telegramUsername
     * @param string $firstName
     * @param string $lastName
     */
    private function createOrUpdateUser(
        string $telegramId,
        string $telegramUsername,
        string $firstName,
        string $lastName
    ): void
    {
        try {
            // Поищем поль-ля в БД, обновим не заполненные данные
            $user = $this->userRepository->findWhere('telegram', $telegramUsername);
            if (!$user) {
                $user = $this->userRepository->findWhere('telegram_id', $telegramId);
            }
            if ($user) {
                if (empty($user->name) && $firstName) {
                    $user->name = $firstName;
                }
                if (empty($user->last_name) && $lastName) {
                    $user->last_name = $lastName;
                }
                if (empty($user->telegram) && $telegramUsername) {
                    $user->telegram = $telegramUsername;
                }
                if (empty($user->telegram_id) && $telegramId) {
                    $user->telegram_id = $telegramId;
                }
                $user->save();

            } else {
                // Если поль-ля не нашлось в БД, сохранить данные как $from_tgbot_unknown = 1
                $attributes['email'] = $this->emailGeneratorService->generateRandomEmail();
                $attributes['password'] = $this->passwordGeneratorService->generateRandomPassword();
                $attributes['telegram_id'] = $telegramId;
                $attributes['telegram'] = $telegramUsername;
                $attributes['name'] = $firstName;
                $attributes['last_name'] = $lastName;
                $attributes['from_tgbot_unknown'] = 1;

                $this->userRepository->create($attributes);
            }
        } catch (Exception $e) {
            Log::error('TelegramService::createOrUpdateUser(). ' . $e->getMessage());
        }

    }
}
