<?php

namespace App\Exceptions;

use App\Builder\ReturnApi;
use Exception;

class ApiException extends Exception
{

    public function __construct(String $error = "Erro inesperado")
    {
        return ReturnApi::error($error);
    }
}
