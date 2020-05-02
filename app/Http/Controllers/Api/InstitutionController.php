<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstitutionController extends Controller
{
    private $institutions = [];

    public function __construct()
    {
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

        return response()->json(["message" => "Não foi encontrado nenhuma instituição para o ID informado."], 404);
    }
}
