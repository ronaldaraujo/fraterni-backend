<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    private $stores = [];

    public function __construct()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));

        for ($i = 0; $i < 30; $i++) {
            $this->stores[$i]["id"] = $i;
            $this->stores[$i]["name"] = $faker->company;
            $this->stores[$i]["city"] = $faker->city;
            $this->stores[$i]["state"] = $faker->state;
            $this->stores[$i]["address"] = $faker->address;
            $this->stores[$i]["cnpj"] = $faker->cnpj;
            $this->stores[$i]["image"] = "https://i.picsum.photos/id/" . $i . "/450/450.jpg";
        }
    }

    public function index()
    {
        return response()->json(['stores' => $this->stores]);
    }
}
