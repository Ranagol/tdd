<?php

namespace App\Domain;

class Coordinate
{
    private string $name;

    private int $x;

    private int $y;

    public function __construct(string $name, int $x, int $y)
    {
        $this->name = $name;
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Get the value of y
     */ 
    public function getY()
    {
        return $this->y;
    }

    /**
     * Get the value of x
     */ 
    public function getX()
    {
        return $this->x;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }
}
