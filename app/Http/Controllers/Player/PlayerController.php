<?php

namespace App\Http\Controllers\Player;

use App\Builder\ReturnApi;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\PlayerController\StoreRequest;
use App\Models\Player;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PlayerController extends Controller
{

    public function index()
    {
        try {
            return ReturnApi::success(Player::all(), "Jogadores Consultados com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao consultar jogadores");
        }
    }

    public function store(StoreRequest $request)
    {
        try {

            $data = $request->validated();

            $player = Player::create([
                "name" => $data["name"],
                "tshirt" => $data["tshirt"]
            ]);

            return ReturnApi::success($player, "Jogador Criado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao criar jogador");
        }
    }

    public function delete($id)
    {

        try {

            $validator = Validator::make(['id' => $id], [
                'id' => 'exists:players,id',
            ]);

            if ($validator->fails()) {
                return ReturnApi::error("Jogador Inexistente");
            }

            Player::where(["id" => $id])->delete();

            return ReturnApi::success($id, "Jogador deletado com sucesso");
        } catch (Throwable $e) {
            throw new ApiException("Erro ao deletar jogador");
        }
    }
}
