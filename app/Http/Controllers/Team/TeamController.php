<?php

namespace App\Http\Controllers\Team;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamController\DeleteRequest;
use App\Http\Requests\Team\TeamController\FindRequest;
use App\Http\Requests\Team\TeamController\StoreRequest;
use App\Http\Requests\Team\TeamController\UpdateRequest;
use App\Models\Team;
use Throwable;

class TeamController extends Controller
{
    public function index()
    {
        try {
            return ReturnApi::success(Team::with("players")->orderBy('points', 'desc')->get(), "Times Consultados com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar Times");
        }
    }

    public function find(FindRequest $request)
    {
        try {

            $data = $request->validated();


            return ReturnApi::success(Team::with("players")->find($data["id"]), "Time consultado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar Time");
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            return ReturnApi::success(Team::create(["name" => $data["name"]]), "Time Criado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao criar Time");
        }
    }

    public function delete(DeleteRequest $request)
    {
        try {
            $data = $request->validated();

            return ReturnApi::success(Team::destroy($data["id"]), "Time Deletado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao deletar Time");
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $data = $request->validated();

            Team::find($data["id"])->update(["name" => $data["name"]]);

            return ReturnApi::success(Team::find($data["id"]), "Time atualizado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao deletar Time");
        }
    }

}
