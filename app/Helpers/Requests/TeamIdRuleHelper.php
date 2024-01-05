<?php

namespace App\Helpers\Requests;


class TeamIdRuleHelper
{

    static function rule(): array
    {
        return [
            "exists:teams,id",
            "required"
        ];
    }

    static function attribute(): string
    {
        return "id do time";
    }
}
