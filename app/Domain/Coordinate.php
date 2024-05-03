<?php

namespace App\Domain;

/**
 * The whole logic is based on a fact that every recangle has 4 points. The location of these
 * points can be defined by the coordinates the point. Every coordinate as a x (longitude) and y 
 * (latitude) values.
 */
class Coordinate
{
    private int $x;

    private int $y;

    public function __construct(int $x, int $y)
    {
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
