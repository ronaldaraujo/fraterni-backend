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
            $this->institutions[$i]["id"] = $faker->uuid;
            $this->institutions[$i]["name"] = $faker->company;
            $this->institutions[$i]["city"] = $faker->city;
            $this->institutions[$i]["state"] = $faker->state;
            $this->institutions[$i]["cnpj"] = $faker->cnpj;
            $this->institutions[$i]["description"] = $faker->text;
            $this->institutions[$i]["image"] = "https://i.picsum.photos/id/" . $i . "/450/450.jpg";
        }

        
    }

    public function index()
    {
        return response()->json(['institutions' => $this->institutions]);
    }
}
