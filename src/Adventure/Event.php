<?php

namespace App\Adventure;

class Event
{
    public $key;
    public $reward;
    public $status;

    public function __construct($key, $reward)
    {
        $this->key = $key;
        $this->reward = $reward;
        $this->status = false;
    }

    public function checkEvent($player)
    {
        if ($player->checkItem($this->key)) {
            $player->deleteItem($this->key);
            $player->addToBag($this->reward);
            $this->status = true;
            return true;
        }
        return false;
    }

    public function eventStatus()
    {
        return $this->status;
    }

    private function getKey()
    {
        return $this->key;
    }
}
