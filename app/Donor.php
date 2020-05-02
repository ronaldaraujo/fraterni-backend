<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    private $balance = 0;

    public function __construct()
    {
        $this->balance = 1200;
    }

    public function getBalance()
    {
        return $this->balance;
    }
}
