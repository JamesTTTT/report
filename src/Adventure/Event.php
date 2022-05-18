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
        $this->status = False;
    }

    public function checkEvent($player){
        if($player->checkItem($this->key)){
            $player->deleteItem($this->key);
            $player->addToBag($this->reward);
            $this->status = True;
            return True;
        }
        return False;
    }

    public function eventStatus(){
        return $this->status;
    }

    private function getKey(){
        return $this->key;
    }

}