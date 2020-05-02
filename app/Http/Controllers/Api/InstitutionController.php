<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Institution;

class InstitutionController extends Controller
{
    private $institutions = [];
    private $institution;

    public function __construct()
    {
        $this->institution = new Institution();

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));

        for ($i = 0; $i < 50; $i++) {
            // $this->institutions[$i]["id"] = $faker->uuid;
            $this->institutions[$i]["id"] = $i;
            $this->institutions[$i]["name"] = $faker->company;
            $this->institutions[$i]["city"] = $faker->city;
            $this->institutions[$i]["state"] = $faker->state;
            $this->institutions[$i]["cnpj"] = $faker->cnpj;
            $this->institutions[$i]["description"] = $faker->text;
            $this->institutions[$i]["items"] = [
                "Criança",
                "Idoso",
                "Sem-teto"
            ];
            $this->institutions[$i]["image"] = "https://i.picsum.photos/id/" . $i . "/450/450.jpg";
            $this->institutions[$i]["gallery"] = [
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
                "https://i.picsum.photos/id/" . $faker->numberBetween(1, 100) . "/250/250.jpg",
            ];
        }
    }

    public function index()
    {
        return response()->json(['institutions' => $this->institutions]);
    }

    public function show(Request $request)
    {
        $id = $request["id"];

        for ($i = 0; $i < count($this->institutions); $i++) {
            if ($this->institutions[$i]["id"] == $id) {
                return response()->json(["institution" => $this->institutions[$i]]);
            }
        }

        return response()->json(["error" => "Não foi encontrado nenhuma instituição para o ID informado."], 404);
    }

    public function take(Request $request)
    {
        if (!$request["value"]) {
            return response()->json(['error' => "Informe o valor de Fraterni que deseja sacar."], 400);
        }

        $balance = $this->institution->getBalance();

        if ($balance < $request["value"]) {
            return response()->json(['error' => "Saldo insuficiente."], 400);
        }

        if ($request["value"] <= 10) {
            return response()->json(['error' => "Transações de saques só podem ser feitas a partir de 10 Fraternis."], 400);
        }

        $fraternis = $balance - $request["value"];

        $real = $request["value"] / 10;

        return response()->json(
            [
                "message" => "Saque efetuado com sucesso. Você ainda possui " . $fraternis . " Fraternis e sacou R$ " . $real,
                "fraternis" => $fraternis,
                "real" => $real,
                "hash" => \Hash::make("Fraterni")
            ]
        );
    }
}
