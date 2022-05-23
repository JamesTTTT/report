<?php

namespace App\Adventure;

/**
 * Event Class.
 *
 * @author James Taylor
 */
class Event
{
    private $key;
    private $reward;
    private $status;

    /**
     * Creates an event the player can interact with.
     * The event adds a reward item in the bag
     * and removes the key item
     * @param object $key
     * @param object $reward
     * @return void
     */
    public function __construct($key, $reward)
    {
        $this->key = $key;
        $this->reward = $reward;
        $this->status = false;
    }

    /**
     * Checks if player has the correct item in the bag
     * if so deletetes the item with deleteItem method.
     * Adds the reward item to the player bag and lastly
     * returns true ig the process is done.
     * @param object $player
     * @return bool
     */
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

    /**
     * returns the status bool
     * @return bool
     */
    public function eventStatus()
    {
        return $this->status;
    }

    /**
     * returns the key object
     * @return object
     */
    private function getKey()
    {
        return $this->key;
    }
}
