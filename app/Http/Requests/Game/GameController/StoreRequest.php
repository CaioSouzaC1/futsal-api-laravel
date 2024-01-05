<?php

namespace App\Http\Requests\Game\GameController;

use App\Helpers\Requests\TeamIdRuleHelper;
use Illuminate\Foundation\Http\FormRequest;

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
            "date" => [
                "datetime",
                "required"
            ],
            "home_team_id" => TeamIdRuleHelper::attribute(),
            "visitor_team_id" => TeamIdRuleHelper::attribute(),
            "home_team_goals" => [
                "interger",
                "min:0",
                "max:20",
                "required"
            ],
            "visitor_team_goals" => [
                "interger",
                "min:0",
                "max:20",
                "required"
            ]
        ];
    }
}
