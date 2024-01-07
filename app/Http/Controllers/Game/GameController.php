<?php

namespace App\Http\Controllers\Game;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\GameController\DeleteRequest;
use App\Http\Requests\Game\GameController\StoreRequest;
use App\Http\Requests\Game\GameController\UpdateRequest;
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

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            $game = Game::create(
                [
                    "date" => $data["date"],
                    "home_team_id" => $data["home_team_id"],
                    "visitor_team_id" => $data["visitor_team_id"],
                    "home_team_goals" => $data["home_team_goals"],
                    "visitor_team_goals" => $data["visitor_team_goals"]
                ]
            );

            return ReturnApi::success($game, "Jogo Criado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao criar Jogo");
        }
    }

    public function delete(DeleteRequest $request)
    {
        try {
            $data = $request->validated();

            return ReturnApi::success(Game::destroy($data["id"]), "Jogo Deletado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao deletar Jogo");
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $data = $request->validated();

            Game::find($data["id"])->update([
                "date" => $data["date"],
                "home_team_id" => $data["home_team_id"],
                "visitor_team_id" => $data["visitor_team_id"],
                "home_team_goals" => $data["home_team_goals"],
                "visitor_team_goals" => $data["visitor_team_goals"]
            ]);

            return ReturnApi::success(Game::find($data["id"]), "Jogo atualizado com sucesso");
        } catch (Throwable $e) {
            return $e;
            throw new ApiException("Erro ao deletar Jogo");
        }
    }
}
