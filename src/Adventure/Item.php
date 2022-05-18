<?php

namespace App\Adventure;

class Item
{
    private string $name;
    private string $icon;
    // private bool $status;

    // Claass constructor for cards
    public function __construct($name, $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
        // $this->status = false;
    }

    // gets the value and suite
    public function getItemName()
    {
        return $this->name;
    }

    // gets the value and suite
    public function getItem()
    {
        $itemData = [$this->name, $this->icon];
        return $itemData;
    }
}