<?php

namespace App\Http\Requests\OAuth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerificationCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'min:3',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Verification code не найден',
            'code.string'   => 'Неверный формат verification code',
            'code.min'      => 'Verification code слишком короткий',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        logger()->error('OAuth сервис не вернул verification code');
        abort(400, 'Code не найден');
    }

    public function getCode(): string
    {
        return $this->string('code')->toString();
    }
}
