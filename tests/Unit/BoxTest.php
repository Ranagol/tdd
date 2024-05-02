<?php

namespace Tests\Unit;

use App\Domain\Box;
use App\Domain\Coordinate;
use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{
    public function testCreateBoxWithThreeCoordinates(): void
    {
        // Arrange
        $this->expectExceptionMessage('A Box always must have 4 coordinates!');

        // Act
        new Box([
            //We deliberatly create a Box with 3 coordinates, this needs to throw an exception
            new Coordinate('a', 50, 150),
            new Coordinate('b', 150, 150),
            new Coordinate('c', 150, 50),
        ]);
    }

    public function testCreateBoxWithFiveCoordinates(): void
    {
        // Arrange
        $this->expectExceptionMessage('A Box always must have 4 coordinates!');

        // Act
        new Box([
            //We deliberatly create a Box with 3 coordinates, this needs to throw an exception
            new Coordinate('a', 50, 150),
            new Coordinate('b', 150, 150),
            new Coordinate('c', 150, 50),
            new Coordinate('c', 150, 50),
            new Coordinate('c', 150, 50),
        ]);
    }

    public function testCreateBoxWithoutUsingCoordinateClass(): void
    {
        // Arrange
        $this->expectExceptionMessage('All elements of $coordinates must be instances of Coordinate');

        // Act
        new Box([
            //Notice that here we do not use the new Coordinate()
            ['a', 50, 150],
            ['b', 150, 150],
            ['c', 150, 50],
            ['d', 50, 50],
        ]);
    }

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
        $this->assertEquals('a', $coordinate->getName());
        $this->assertEquals(50, $coordinate->getX());
        $this->assertEquals(150, $coordinate->getY());
    }

    public function testWhenCoordinateIsNotFoundByName(): void
    {
        // Arrange
        $coordinates = [
            new Coordinate('a', 50, 150),
            new Coordinate('b', 150, 150),
            new Coordinate('c', 150, 50),
            new Coordinate('d', 50, 50),
        ];

        $box = new Box($coordinates);

        $this->expectExceptionMessage('Coordinate not found');

        // Act
        $coordinate = $box->getCoordinateByName('e');
    }

    public function testBoxIsJustADot(): void//same coordinates
    {
        // Arrange
        
    }

    public function testIsTheBoxARectangle(): void//when the angles are not 90 degrees
    {
        // Arrange
        
    }
}
