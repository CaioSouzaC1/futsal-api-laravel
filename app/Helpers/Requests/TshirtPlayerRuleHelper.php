<?php

namespace App\Helpers\Requests;

use Illuminate\Validation\Rule;

class TshirtPlayerRuleHelper
{

    static function rule($team_id): array
    {
        return [
            "int",
            "min:0",
            "max:999",
            Rule::unique('players')->where(function ($query) use ($team_id) {
                return $query->where('team_id', $team_id);
            }),
            "required"
        ];
    }

    static function attribute(): string
    {
        return "número da camisa";
    }
}
