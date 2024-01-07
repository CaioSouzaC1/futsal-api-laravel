<?php

namespace App\Helpers\Requests;


class TeamGoalsRuleHelper
{

    static function rule(): array
    {
        return [
            "integer",
            "min:0",
            "max:20",
            "required"
        ];
    }
}
