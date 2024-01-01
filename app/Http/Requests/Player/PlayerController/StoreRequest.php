<?php

namespace App\Http\Requests\Player\PlayerController;

use App\Builder\ReturnApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
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
            "name" => [
                "string",
                "required"
            ],
            "tshirt" => [
                "int",
                "min:0",
                "max:999"
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => "nome",
            "tshirt" => "camisa",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, ReturnApi::error($validator->errors()->first(), $validator->errors()->toArray()));
    }
}