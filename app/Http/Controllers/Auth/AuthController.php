<?php

namespace App\Http\Controllers\Auth;

use App\Builder\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthController\LoginRequest;
use App\Http\Requests\Auth\AuthController\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        return ReturnApi::success(
            User::create(
                [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "password"  => Hash::make($data["password"])
                ]
            ),
            "Usuário criado com sucesso!"
        );
    }

    public function login(LoginRequest $request)
    {

        $data = $request->validated();

        if (Auth::attempt(["email" => $data["email"], "password" => $data["password"]])) {

            $token = JWTAuth::fromUser(Auth::user());

            return ReturnApi::success(["user" => Auth::user(), "token" => $token], "Usuário encontrado com sucesso");
        }

        return ReturnApi::error("Usuário não encontrado");
    }

    public function me()
    {
        return ReturnApi::success(JWTAuth::user(), "Usuário encontrado");
    }
}
