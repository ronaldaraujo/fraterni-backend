<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonorController extends Controller
{

    private $profile = [];

    public function __construct()
    {

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));

        $this->profile["name"] = "Ronald Araújo";
        $this->profile["cpf"] = "000.000.000-00";
        $this->profile["email"] = "f.ronaldaraujo@gmail.com";
        $this->profile["balance"] = "120 Fraternis";
        $this->profile["image"] = "https://api.adorable.io/avatars/285/f.ronaldaraujo@gmail.com";

        for ($i = 0; $i < 9; $i++) {
            $this->profile["transations"][$i] = [
                "id" => $faker->uuid,
                "institution" => $faker->company,
                "value" => $faker->numberBetween(100, 300)
            ];
        }
    }

    public function index()
    {
        return response()->json(["profile" => $this->profile]);
    }
}
