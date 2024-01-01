<?php

namespace App\Http\Controllers\Team;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Throwable;

class TeamController extends Controller
{
    public function index()
    {
        try {
            return ReturnApi::success(Team::all(), "Times Consultados com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar Times");
        }
    }
}
