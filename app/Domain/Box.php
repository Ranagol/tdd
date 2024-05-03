<?php

namespace App\Domain;

use App\Domain\Coordinate;
use App\Exceptions\IdenticalCoordinatesException;
use App\Exceptions\NotARectangleException;
use App\Exceptions\WrongNumberOfArgumentsException;
use Exception;

/**
 * sail artisan test tests/Unit/BoxTest.php
 * 
 * The Box class is being inherited by: ProductBox, TextBox.
 */
class Box
{
    protected string $type;

    protected Coordinate $a;
    protected Coordinate $b;
    protected Coordinate $c;
    protected Coordinate $d;

    public function __construct(
        Coordinate $a,
        Coordinate $b,
        Coordinate $c,
        Coordinate $d
    )
    {
        //Check if the number of arguments is exactly 4
        if (func_num_args() !== 4) {
            throw new WrongNumberOfArgumentsException('You must provide exactly 4 coordinates to create a Box!');
            return;
        }

        //Check if the coordinates form a rectangle
        if (!$this->isRectangle($a, $b, $c, $d)) {
            throw new NotARectangleException('The coordinates you gave do not form a convex rectangle with 90-degree angles, as they should!');
            return;
        }   

        //Check if the coordinates are identical
        if ($this->areCoordinatesIdentical($a, $b, $c, $d)) {
            throw new IdenticalCoordinatesException('The coordinates you gave are identical, which is not allowed!');
            return;
        }
        
        //Assign the coordinates
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
    }

    private function areCoordinatesIdentical(
        Coordinate $a,
        Coordinate $b,
        Coordinate $c,
        Coordinate $d
    ): bool
    {
        if ($a->isEqual($b) || $a->isEqual($c) || $a->isEqual($d) || $b->isEqual($c) || $b->isEqual($d) || $c->isEqual($d)) {
            return true;
        }
        return false;
    }


    /**
     * Returns true if the coordinates form a convex rectangle with 90-degree angles.
     * 
     * To check if four coordinates form a convex rectangle with 90-degree angles, you can use the 
     * concept of vector dot product. The dot product of two vectors is zero if the angle between 
     * them is 90 degrees. This function calculates the vectors between the points and then checks 
     * if the dot product of each pair of adjacent vectors is zero, which would indicate a 90-degree 
     * angle.Note: This function assumes that the coordinates are given in clockwise or 
     * counterclockwise order. If the coordinates can be in any order, you would need a more complex 
     * algorithm to check if they form a rectangle.
     *
     * @return boolean
     */
    private function isRectangle(
        Coordinate $a,
        Coordinate $b,
        Coordinate $c,
        Coordinate $d
    ): bool
    {
        $vectors = [
            [$a->getX() - $b->getX(), $a->getY() - $b->getY()],
            [$b->getX() - $c->getX(), $b->getY() - $c->getY()],
            [$c->getX() - $d->getX(), $c->getY() - $d->getY()],
            [$d->getX() - $a->getX(), $d->getY() - $a->getY()],
        ];

        // Check if all angles are 90 degrees
        for ($i = 0; $i < 4; $i++) {
            $dotProduct = $vectors[$i][0] * $vectors[($i + 1) % 4][0] + $vectors[$i][1] * $vectors[($i + 1) % 4][1];
            if ($dotProduct != 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the value of a
     */ 
    public function getCoordinateA()
    {
        return $this->a;
    }

    /**
     * Get the value of b
     */ 
    public function getCoordinateB()
    {
        return $this->b;
    }

    /**
     * Get the value of c
     */ 
    public function getCoordinateC()
    {
        return $this->c;
    }

    /**
     * Get the value of d
     */ 
    public function getCoordinateD()
    {
        return $this->d;
    }
}