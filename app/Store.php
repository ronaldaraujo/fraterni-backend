<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    private $balance = 0;

    public function __construct()
    {
        $this->balance = 1000;
    }

    public function getBalance()
    {
        return $this->balance;
    }
}
