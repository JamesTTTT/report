<?php

namespace App\Adventure;

class Item
{
    private string $name;
    private string $icon;
    private bool $picked;

    // Claass constructor for cards
    public function __construct($name, $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->picked = false;
    }

    // gets the value and suite
    public function getItemName()
    {
        return $this->name;
    }

    // gets the value and suite
    public function getItem()
    {
        $itemData = [$this->name, $this->icon,$this->picked];
        return $itemData;
    }

    public function pickItem()
    {
        $this->picked = true;
    }
}
