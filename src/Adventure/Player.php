<?php

namespace App\Adventure;

class Player
{
    public $bag = [];

    public function addToBag($item)
    {
        array_push($this->bag, $item);
        $item->pickItem();
    }

    public function showBag()
    {
        return $this->bag;
    }

    public function deleteItem($item)
    {
        $key = array_search($item, $this->bag);
        unset($this->bag[$key]);
        sort($this->bag);
    }

    public function checkItem($item)
    {
        // return in_array($item, $this->bag);
        foreach ($this->bag as $baggedItem) {
            if ($baggedItem->getItemName() === $item->getItemName()) {
                return true;
            }
        }
        return false;
    }
}
