<?php

namespace App\Http\Controllers\Player;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\PlayerController\DeleteRequest;
use App\Http\Requests\Player\PlayerController\FindRequest;
use App\Http\Requests\Player\PlayerController\StoreRequest;
use App\Http\Requests\Player\PlayerController\UpdateRequest;
use App\Models\Player;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PlayerController extends Controller
{

    public function index()
    {
        try {
            return ReturnApi::success(Player::with(["team"])->orderBy('team_id')->get(), "Jogadores Consultados com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar jogadores");
        }
    }

    public function find(FindRequest $request)
    {
        try {

            $data = $request->validated();
            return ReturnApi::success(Player::with("team")->find($data["id"]), "Jogador consultado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar jogador");
        }
    }

    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            return ReturnApi::success(
                Player::create([
                    "name" => $data["name"], "tshirt" => $data["tshirt"], "team_id" => $data["team_id"]
                ]),
                "Jogador Criado com sucesso"
            );
        } catch (Throwable $e) {
            throw new ApiException("Erro ao criar jogador");
        }
    }

    public function delete(DeleteRequest $request)
    {
        try {
            $data = $request->validated();

            return ReturnApi::success(Player::destroy($data["id"]), "Jogador deletado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao deletar jogador");
        }
    }

    public function update(UpdateRequest $request)
    {
        try {

            $data = $request->validated();

            Player::find($data["id"])->update(["name" => $data["name"], "tshirt" => $data["tshirt"], "team_id" => $data["team_id"]]);
            return ReturnApi::success(Player::find($data["id"]), "Jogador atualizado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao atualizar jogador");
        }
    }
    
}
