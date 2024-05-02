<?php

namespace App\Domain;

use App\Domain\Coordinate;
use Exception;

/**
 * sail artisan test tests/Unit/BoxTest.php
 */
class Box
{
    protected string $type;

    protected array $coordinates;

    public function __construct($coordinates)
    {
        $this->thereMustBeFourCoordinates($coordinates);
        $this->checkInstanceOfCoordinate($coordinates);
        $this->coordinatesMustBeNamedABCD($coordinates);

        $this->coordinates = $coordinates;
    }

    /**
     * Get the value of coordinates
     * 
     * @return array
     */ 
    public function getCoordinates(): array
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
     * @throws Exception
     * @return Coordinate
     */
    public function getCoordinateByName(string $name): Coordinate
    {
        $requiredCoordinate = null;

        foreach ($this->coordinates as $coordinate) {
            if ($coordinate->getName() === $name) {
                $requiredCoordinate = $coordinate;
            }
        }

        if ($requiredCoordinate === null) {
            throw new Exception('Coordinate not found');
        } else {
            return $requiredCoordinate;
        }
    }

    /**
     * Checks if there are 4 coordinates in the array.
     *
     * @param array $coordinates
     * @throws Exception
     * @return void
     */
    private function thereMustBeFourCoordinates(array $coordinates): void
    {
        if (count($coordinates) !== 4) {
            throw new Exception('A Box always must have 4 coordinates!');
        }
    }

    /**
     * Checks if all elements of $coordinates are instances of Coordinate.
     *
     * @param array $coordinates
     * @throws Exception
     * @return void
     */
    private function checkInstanceOfCoordinate(array $coordinates): void
    {
        foreach ($coordinates as $coordinate) {
            if (!$coordinate instanceof Coordinate) {
                throw new Exception('All elements of $coordinates must be instances of Coordinate');
            }
        }
    }

    /**
     * Checks if the names of the coordinates are one of these: a, b, c, d.
     *
     * @param array $coordinates
     * @throws Exception
     * @return void
     */
    private function coordinatesMustBeNamedABCD(array $coordinates): void
    {
        $names = ['a', 'b', 'c', 'd'];

        foreach ($coordinates as $coordinate) {
            if (!in_array($coordinate->getName(), $names)) {
                throw new Exception('The names of the coordinates must be a, b, c, d');
            }
        }
    }
}