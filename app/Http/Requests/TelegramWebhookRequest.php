<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelegramWebhookRequest extends FormRequest
{
    public function rules() {
        return [
            'message' => ['required', 'array'],

            // Отправитель
            'message.from' => [
                'required_with:message',
                'array'
            ],
            'message.from.id' => [
                'required_with:message.from',
                'integer',
                'min:1'
            ],
            'message.from.first_name' => [
                'required_with:message.from',
                'string',
                'max:255'
            ],
            'message.from.last_name' => [
                'nullable',
                'string',
                'max:255'
            ],
            'message.from.username' => [
                'nullable',
                'string',
                'regex:/^[a-zA-Z0-9_]{5,32}$/'
            ],
            'message.text' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function telegramId(): ?string
    {
        return data_get($this->all(), 'message.from.id');
    }

    public function telegram(): ?string
    {
        return data_get($this->all(), 'message.from.username');
    }

    public function name(): ?string
    {
        return data_get($this->all(), 'message.from.first_name');
    }

    public function lastName(): ?string
    {
        return data_get($this->all(), 'message.from.last_name');
    }

    public function text(): ?string
    {
        return data_get($this->all(), 'message.text');
    }
}

