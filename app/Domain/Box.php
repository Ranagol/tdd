<?php

namespace App\Domain;

use App\Domain\Coordinate;

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

    public function getCoordinateByName(string $name): Coordinate
    {
        foreach ($this->coordinates as $coordinate) {
            if ($coordinate->getName() === $name) {
                return $coordinate;
            }
        }
    }
}