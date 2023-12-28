<?php

namespace App\Exceptions;

use App\Builder\ReturnApi;

class ApiException
{

    public function __construct(String $error = "Erro inesperado")
    {
        return ReturnApi::error($error);
    }
}
