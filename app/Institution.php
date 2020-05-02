<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    private $balance = 0;

    public function __construct()
    {
        $this->balance = 900;
    }

    public function getBalance()
    {
        return $this->balance;
    }
}
