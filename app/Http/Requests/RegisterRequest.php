<?php

namespace App\Http\Requests;

use App\Services\PasswordGeneratorService;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:3'],
            'password_verified' => ['required', 'integer'],
        ];
    }

    public function credentials(): array
    {
        $password = (new PasswordGeneratorService())->hash($this->input('password'));
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => $password,
            'password_verified' => $this->input('password_verified'),
        ];
    }
}
