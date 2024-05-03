<?php

namespace App\Domain;

class Coordinate
{
    private int $x;

    private int $y;

    //TODO ANDOR do I need to write tests for type hinting in the constructor? 
    //For the case, when for example strings are inserted as arguments?

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Get the value of y
     */ 
    //TODO ANDOR do I need to write unit tests for simple getters and setters?
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
     * Returns true if the coordinate x and y values are equal to the other coordinate x and y values
     *
     * @param Coordinate $other
     * @return boolean
     */
    public function isEqual(Coordinate $other): bool
    {
        return $this->getX() === $other->getX() && $this->getY() === $other->getY();
    }
}
