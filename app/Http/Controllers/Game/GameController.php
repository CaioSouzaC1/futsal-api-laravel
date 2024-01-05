<?php

namespace App\Http\Controllers\Game;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\GameController\StoreRequest;
use App\Models\Game;
use Throwable;

class GameController extends Controller
{
    public function index()
    {
        try {
            return ReturnApi::success(Game::get(), "Jogos consultados com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar Jogos");
        }
    }

    // public function find(FindRequest $request)
    // {
    //     try {

    //         $data = $request->validated();


    //         return ReturnApi::success(Team::with("players")->find($data["id"]), "Jogo consultado com sucesso");
    //     } catch (Throwable $e) {
    //         throw new ApiException("Erro ao consultar Jogo");
    //     }
    // }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            return $data;

            return ReturnApi::success(Game::create(["name" => $data["name"]]), "Jogo Criado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao criar Jogo");
        }
    }

    // public function delete(DeleteRequest $request)
    // {
    //     try {
    //         $data = $request->validated();

    //         return ReturnApi::success(Team::destroy($data["id"]), "Jogo Deletado com sucesso");
    //     } catch (Throwable $e) {
    //         throw new ApiException("Erro ao deletar Jogo");
    //     }
    // }

    // public function update(UpdateRequest $request)
    // {
    //     try {
    //         $data = $request->validated();

    //         Team::find($data["id"])->update(["name" => $data["name"]]);

    //         return ReturnApi::success(Team::find($data["id"]), "Jogo atualizado com sucesso");
    //     } catch (Throwable $e) {
    //         throw new ApiException("Erro ao deletar Jogo");
    //     }
    // }
}
