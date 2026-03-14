<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CaptchaService
{
    /**
     * Генерация математической капчи
     * Возвращает массив с вопросом и ответом
     */
    public static function generate(): array
    {
        $num1 = random_int(1, 10);
        $num2 = random_int(1, 10);
        $operators = ['+', '-', '*'];
        $operator = $operators[array_rand($operators)];

        // Вычисляем правильный ответ
        $answer = match($operator) {
            '+' => $num1 + $num2,
            '-' => $num1 - $num2,
            '*' => $num1 * $num2,
        };

        $question = "$num1 $operator $num2 = ?";

        // Сохраняем ответ в сессии
        Session::put('captcha_answer', $answer);
        Session::put('captcha_time', time());

        return [
            'question' => $question,
        ];
    }

    /**
     * Проверка ответа капчи
     */
    public static function check(?string $answer): bool
    {
        if (!$answer) {
            return false;
        }

        // Проверяем время жизни капчи (5 минут)
        $captchaTime = Session::get('captcha_time', 0);
        if (time() - $captchaTime > 300) {
            Session::forget('captcha_answer', 'captcha_time');
            return false;
        }

        $correctAnswer = Session::get('captcha_answer');
        
        if ($correctAnswer === null) {
            return false;
        }

        // Очищаем капчу после проверки (одноразовая)
        Session::forget('captcha_answer', 'captcha_time');

        return (int)$answer === $correctAnswer;
    }

    /**
     * Очистка капчи
     */
    public static function clear(): void
    {
        Session::forget('captcha_answer', 'captcha_time');
    }
}
