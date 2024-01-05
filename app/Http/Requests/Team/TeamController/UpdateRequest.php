<?php

namespace App\Http\Requests\Team\TeamController;

use App\Builder\ReturnApi;
use App\Helpers\Requests\TeamIdRuleHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
            "id" => TeamIdRuleHelper::attribute(),
            "name" => [
                "string",
                "min:8",
                "unique:teams,name",
                "required"
            ]
        ];
    }


    public function attributes(): array
    {
        return [
            "name" => "nome",
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, ReturnApi::error($validator->errors()->first(), $validator->errors()->toArray()));
    }
}
