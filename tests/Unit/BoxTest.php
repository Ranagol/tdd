<?php

namespace Tests\Unit;

use App\Domain\Box;
use App\Domain\Coordinate;
use App\Exceptions\WrongNumberOfArgumentsException;
use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{
    // TODO ANDOR how to test for 3 coordinates, when I am immediately getting an Intelisense/php error?
    // public function testWhenMakingBoxFromThreeCoordinates(): void
    // {
    //     // Arrange
    //     $this->expectException(\ArgumentCountError::class);

    //     $box = new Box(
    //         new Coordinate(60, 80),
    //         new Coordinate(80, 80),
    //         new Coordinate(80, 60),
    //         // new Coordinate(60, 60),
    //     );
    // }

    /**
     * // TODO Here we have an issue. PHP is supposed to throw an ArgumentCountError automatically,
     * when we pass in the wrong number of arguments. However, it does not.
     * https://www.php.net/manual/en/class.argumentcounterror.php
     * 
     * The problem is, that no ArgumentCountError is thrown, when we pass in 5 coordinates,
     * @return void
     */
    // public function testWhenMakingBoxFromFiveCoordinates(): void
    // {
    //     // Arrange
    //     $this->expectException(\ArgumentCountError::class);

    //     $box = new Box(
    //         new Coordinate(60, 80),
    //         new Coordinate(80, 80),
    //         new Coordinate(80, 60),
    //         new Coordinate(60, 60),
    //         new Coordinate(60, 60),
    //     );
    // }

    // TODO how to test for this situation, when php does not allow this, because expects Coordinate class??
    // public function testWhenMakingBoxWithoutCoordinateClass(): void
    // {
    //     // Arrange
    //     $box = new Box(
    //         [60, 80],
    //         [80, 80],
    //         [80, 60],
    //         [60, 60],
    //     );
    // }
        
    public function testWhenBoxIsJustADot(): void//same coordinates
    {
        $box = new Box(
            new Coordinate(60, 60),
            new Coordinate(60, 60),
            new Coordinate(60, 60),
            new Coordinate(60, 60),
        );

        $this->assertTrue(true);
    }

    // public function testIsTheBoxARectangle(): void//when the angles are not 90 degrees
    // {
    //     // Arrange
        
    // }
}
