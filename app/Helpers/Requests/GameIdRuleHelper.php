<?php

namespace App\Helpers\Requests;


class GameIdRuleHelper
{

    static function rule(): array
    {
        return [
            "exists:games,id",
            "required"
        ];
    }

    static function attribute(): string
    {
        return "id do jogo";
    }
}
