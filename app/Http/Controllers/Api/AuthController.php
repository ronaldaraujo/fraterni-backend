<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $user = [];

    public function __construct()
    {
        $this->user["name"] = "Ronald Araújo";
        $this->user["email"] = "f.ronaldaraujo@gmail.com";
        $this->user["password"] = "123456";
    }

    public function signUp(Request $request)
    {
        if (!$request["name"] || !$request["cpf"] || !$request["email"] || !$request["password"]) {
            return response()->json(["error" => "Os seguintes campos são obrigatórios: Nome, CPF, E-mail e Senha"], 400);
        }

        return response()->json(["message" => "Cadastro realizado com sucesso."]);
    }

    public function signIn(Request $request)
    {
        if ($request["email"] !== $this->user["email"] || $request["password"] !== $this->user["password"]) {
            return response()->json(["error" => "E-mail ou senha incorretos."], 400);
        }

        return response()->json(["message" => "Login realizado com sucesso."]);
    }
}
