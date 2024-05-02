<?php

namespace App\Domain;

use App\Domain\Coordinate;

/**
 * sail artisan test tests/Unit/BoxTest.php
 */
class Box
{
    protected string $type;

    protected array $coordinates;

    public function __construct($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * Get the value of coordinates
     */ 
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * A Box class has 4 coordinates, named a, b, c, d. 
     * This is the order of the coordinates:
     * 
     * a -> b
     *      |
     * d <- č
     * 
     * This method returns the coordinate by name. 
     *
     * @param string $name
     * @return Coordinate | null
     */
    public function getCoordinateByName(string $name): Coordinate | null
    {
        $requiredCoordinate = null;

        foreach ($this->coordinates as $coordinate) {
            if ($coordinate->getName() === $name) {
                $requiredCoordinate = $coordinate;
            }
        }

        return $requiredCoordinate;
    }
}