<?php

namespace App\Adventure;

/**
 * Player Class.
 *
 * @author James Taylor
 */
class Player
{
    private $bag = [];

    /**
     * If the player clicks on an item
     * the item will be added to the bag array.
     * The item method pickItem gets called.
     * @param object $item
     * @return void
     */
    public function addToBag($item)
    {
        array_push($this->bag, $item);
        $item->pickItem();
    }

    /**
     * Shows the bag
     * @return array (Item bag)
     */
    public function showBag()
    {
        return $this->bag;
    }

    /**
     * Searches bag for given item index and
     * when the item is found removes it with unset.
     * Lastly sortes the bag
     * @param object $item
     * @return void
     */
    public function deleteItem($item)
    {
        $key = array_search($item, $this->bag,true);
        unset($this->bag[$key]);
        sort($this->bag);
    }

    /**
     * Checks if item exists in the bag
     * by comparing item names of given item and all the items
     * in the bag until its found.
     * if item is found true is returned
     * and false if not found.
     * @param object $item
     * @return bool
     */
    public function checkItem($item)
    {
        foreach ($this->bag as $baggedItem) {
            if ($baggedItem->getItemName() === $item->getItemName()) {
                return true;
            }
        }
        return false;
    }
}
