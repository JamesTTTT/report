<?php

namespace App\Adventure;

/**
 * Item Class.
 *
 * @author James Taylor
 */
class Item
{
    private string $name;
    private string $icon;
    private bool $picked;

    /**
     * Construct method
     * creates item with a name and path to icon image.
     * picked status set to false on creation.
     * @param string $name
     * @param string $icon
     * @return void
     */
    public function __construct($name, $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->picked = false;
    }

    /**
     * returns the name of item
     * @return string
     */
    public function getItemName()
    {
        return $this->name;
    }

    /**
     * returns the item data
     * @return array<mixed> (item name, item icon and picked status)
     */
    public function getItem()
    {
        $itemData = [$this->name, $this->icon,$this->picked];
        return $itemData;
    }

    /**
     * sets the items picked status to true
     * @return void
     */
    public function pickItem()
    {
        $this->picked = true;
    }
}
