<?php

namespace Tests\Unit;

use App\Domain\Box;
use App\Domain\Coordinate;
use PHPUnit\Framework\TestCase;
use App\Exceptions\NotARectangleException;
use App\Exceptions\IdenticalCoordinatesException;
use App\Exceptions\WrongNumberOfArgumentsException;

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

    public function testWhenMakingBoxFromFiveCoordinates(): void
    {
        // Arrange
        $this->expectException(WrongNumberOfArgumentsException::class);

        $box = new Box(
            new Coordinate(60, 80),
            new Coordinate(80, 80),
            new Coordinate(80, 60),
            new Coordinate(60, 60),
            new Coordinate(60, 60),
        );
    }
        
    public function testWhenBoxIsJustADot(): void//same coordinates
    {
        // Arrange
        $this->expectException(IdenticalCoordinatesException::class);
        $box = new Box(
            new Coordinate(60, 60),
            new Coordinate(60, 60),
            new Coordinate(60, 60),
            new Coordinate(60, 60),
        );
    }

    public function testWhenTheBoxIsNotARectangle(): void//when the angles are not 90 degrees
    {
        // Arrange
        $this->expectException(NotARectangleException::class);
        
        $box = new Box(
            new Coordinate(62, 82),
            new Coordinate(80, 84),
            new Coordinate(88, 63),
            new Coordinate(64, 68),
        );
    }
}
