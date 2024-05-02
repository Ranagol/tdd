<?php

namespace Tests\Unit;

use App\Domain\Box;
use App\Domain\Coordinate;
use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{
    public function testGetCoordinateByName(): void
    {
        // Arrange
        $coordinates = [
            new Coordinate('a', 50, 150),
            new Coordinate('b', 150, 150),
            new Coordinate('c', 150, 50),
            new Coordinate('d', 50, 50),
        ];

        $box = new Box($coordinates);

        // Act
        $coordinate = $box->getCoordinateByName('a');

        // Assert
        $this->assertEquals(50, $coordinate->getX());
        $this->assertEquals(150, $coordinate->getY());
    }

    public function testWhenCoordinateIsNotFound(): void
    {
        // Arrange
        $coordinates = [
            new Coordinate('a', 50, 150),
            new Coordinate('b', 150, 150),
            new Coordinate('c', 150, 50),
            new Coordinate('d', 50, 50),
        ];

        $box = new Box($coordinates);

        // Act
        $coordinate = $box->getCoordinateByName('e');

        // Assert
        $this->assertNull($coordinate);
    }
}
