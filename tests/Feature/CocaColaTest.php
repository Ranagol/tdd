<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\TextBox;
use App\Domain\Coordinate;
use App\Domain\ProductBox;
use App\Domain\BoxPositionChecker;

/**
 * sail artisan test tests/Feature/CocaColaTest.php
 */
class CocaColaTest extends TestCase
{

    // public array $insideCoordinates = [
    //     new Coordinate(60, 80),
    //     new Coordinate(80, 80),
    //     new Coordinate(80, 60),
    //     new Coordinate(60, 60),
    // ];

    // public array $outsideCoordinates = [
    //     new Coordinate(170, 80),
    //     new Coordinate(190, 80),
    //     new Coordinate(190, 60),
    //     new Coordinate(170, 60),
    // ];

    // public array $productBoxCoordinates = [
    //     new Coordinate(50, 150),
    //     new Coordinate(150, 150),
    //     new Coordinate(150, 50),
    //     new Coordinate(50, 50),
    // ];


    public function testTextBoxIsInsideProductBox(): void
    {
        // Arrange
        $textBoxInside = new TextBox(
            new Coordinate(60, 80),
            new Coordinate(80, 80),
            new Coordinate(80, 60),
            new Coordinate(60, 60),
        );

        $productBox = new ProductBox(
            new Coordinate(50, 150),
            new Coordinate(150, 150),
            new Coordinate(150, 50),
            new Coordinate(50, 50),
        );

        $boxPositionChecker = new BoxPositionChecker();

        // Act
        $isTextBoxInsideProductBox = $boxPositionChecker->isTextBoxInsideProductBox($productBox, $textBoxInside);

        // Assert
        $this->assertTrue($isTextBoxInsideProductBox);
    }

    public function testTextBoxIsOutsideProductBox(): void
    {
        // Arrange
        $textBoxOutside = new TextBox(
            new Coordinate(170, 80),
            new Coordinate(190, 80),
            new Coordinate(190, 60),
            new Coordinate(170, 60),
        );

        $productBox = new ProductBox(
            new Coordinate(50, 150),
            new Coordinate(150, 150),
            new Coordinate(150, 50),
            new Coordinate(50, 50),
        );

        $boxPositionChecker = new BoxPositionChecker();

        // Act
        $isTextBoxInsideProductBox = $boxPositionChecker->isTextBoxInsideProductBox($productBox, $textBoxOutside);

        // Assert
        $this->assertFalse($isTextBoxInsideProductBox);
    }

    public function testTextBoxIsPartiallyOutsideOfProductBox(): void
    {
        // Arrange
        $productBox = new ProductBox(
            new Coordinate(100, 500),
            new Coordinate(500, 500),
            new Coordinate(500, 100),
            new Coordinate(100, 100),
        );

        $textBox = new TextBox(
            new Coordinate(400, 400),
            new Coordinate(600, 400),
            new Coordinate(600, 300),
            new Coordinate(400, 300),
        );

        $boxPositionChecker = new BoxPositionChecker();

        // Act
        $isTextBoxInsideProductBox = $boxPositionChecker->isTextBoxInsideProductBox($productBox, $textBox);

        // Assert
        $this->assertFalse($isTextBoxInsideProductBox);
    }

    public function testTextBoxTopLineIsPerfectlyOnProductBoxTopLine(): void
    {
        // Arrange
        $productBox = new ProductBox(
            new Coordinate(50, 150),
            new Coordinate(150, 150),
            new Coordinate(150, 50),
            new Coordinate(50, 50),
        );

        $textBox = new TextBox(
            new Coordinate(50, 150),
            new Coordinate(150, 150),
            new Coordinate(150, 60),
            new Coordinate(50, 60),
        );

        $boxPositionChecker = new BoxPositionChecker();

        // Act
        $isTextBoxInsideProductBox = $boxPositionChecker->isTextBoxInsideProductBox($productBox, $textBox);

        // Assert
        $this->assertTrue($isTextBoxInsideProductBox);
    }

    public function testTextBoxHasTheSameCoordinatesAsProductBox(): void
    {
        // Arrange
        $productBox = new ProductBox(
            new Coordinate(50, 150),
            new Coordinate(150, 150),
            new Coordinate(150, 50),
            new Coordinate(50, 50),
        );

        $textBox = new TextBox(
            new Coordinate(50, 150),
            new Coordinate(150, 150),
            new Coordinate(150, 50),
            new Coordinate(50, 50),
        );

        $boxPositionChecker = new BoxPositionChecker();

        // Act
        $isTextBoxInsideProductBox = $boxPositionChecker->isTextBoxInsideProductBox($productBox, $textBox);

        // Assert
        $this->assertTrue($isTextBoxInsideProductBox);
    }

}