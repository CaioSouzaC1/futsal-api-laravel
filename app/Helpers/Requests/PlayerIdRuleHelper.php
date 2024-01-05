<?php

namespace App\Helpers\Requests;


class PlayerIdRuleHelper
{

    static function rule(): array
    {
        return [
            "exists:players,id",
            "required"
        ];
    }

    static function attribute(): string
    {
        return "id do jogador";
    }
}
