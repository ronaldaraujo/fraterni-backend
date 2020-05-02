<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;

class StoreController extends Controller
{
    private $stores = [];
    private $me = [];

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

        $store = new Store();
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));

        $this->me["name"] = "Minha Empresa S.A.";
        $this->me["email"] = "contato@minhaempresa.com.br";
        $this->me["cnpj"] = "000000000000";
        $this->me["balance"] = $store->getBalance();
        $this->me["image"] = "https://i.picsum.photos/id/1001/450/450.jpg";
        
        for ($i = 0; $i < 9; $i++) {
            $this->me["transations"][$i] = [
                "id" => $faker->uuid,
                "institution" => $faker->company,
                "value" => $faker->numberBetween(100, 300),
                "hash" => \Hash::make("Fraterni")
            ];
        }

        for ($i = 9; $i < 19; $i++) {
            $this->me["transations"][$i] = [
                "id" => $faker->uuid,
                "donor" => $faker->name,
                "value" => $faker->numberBetween(100, 300),
                "hash" => \Hash::make("Fraterni")
            ];
        }
    }

    public function index()
    {
        return response()->json(['stores' => $this->stores]);
    }

    public function me()
    {
        return response()->json(['me' => $this->me]);
    }
}
