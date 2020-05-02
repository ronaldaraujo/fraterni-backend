<?php

namespace App\Http\Controllers\Api;

use App\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    private $wallet = 10;
    private $donor;

    public function __construct()
    {
        $this->donor = new Donor();
    }

    public function index(Request $request)
    {
        if (!$request["name_card"] || !$request["number_card"] || !$request["cvv"] || !$request["value"]) {
            return response()->json(["error" => "Os seguintes campos são obrigatórios: Nome igual ao do cartão, Número do cartão, CCV (código de segurança) e Valor da doação."], 400);
        }

        $fraterni = floatval($request["value"]) * 0.01;

        $total = $this->donor->getBalance() + $fraterni;

        return response()->json([
            "message" => "Doação realizada com sucesso. Você recebeu " . $fraterni . "Fraternis em sua conta.",
            "total" => $total,
            "hash" => "Essa hash BlockChain é o seu comprovante de doação e geração de Fraterni: " . \Hash::make("Fraterni")
        ]);
    }
}
