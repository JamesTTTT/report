<?php

namespace App\Adventure;

class Obstacle
{
    public $key;
    public $name;

    public function __construct($key, $name)
    {
        $this->player = $player;
        $this->bank = $bank;
    }

    private function getObsName(){
        return $this->name;
    }

    private function getKey(){
        return $this->key;
    }

}