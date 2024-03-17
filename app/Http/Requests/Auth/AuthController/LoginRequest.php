<?php

namespace App\Http\Requests\Auth\AuthController;

use App\Builder\ReturnApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "email" => [
                "email",
                "required",
            ],
            "password" => [
                "string",
                "required",
                "min:6"
            ],
        
        ];
    }

    public function attributes(): array
    {
        return [
            "email" => "e-mail",
            "password" => "senha",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, ReturnApi::error($validator->errors()->first(), $validator->errors()->toArray()));
    }
}
