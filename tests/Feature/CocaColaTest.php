<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Domain\TextBox;
use App\Domain\Coordinate;
use App\Domain\ProductBox;
use App\Domain\DecisionMaker;
use App\Domain\TextBoxInside;
use App\Domain\TextBoxOutside;

/**
 * sail artisan test tests/Feature/CocaColaTest.php
 */
class CocaColaTest extends TestCase
{

    // public array $insideCoordinates = [
    //     new Coordinate('a', 60, 80),
    //     new Coordinate('b', 80, 80),
    //     new Coordinate('c', 80, 60),
    //     new Coordinate('d', 60, 60),
    // ];

    // public array $outsideCoordinates = [
    //     new Coordinate('a', 170, 80),
    //     new Coordinate('b', 190, 80),
    //     new Coordinate('c', 190, 60),
    //     new Coordinate('d', 170, 60),
    // ];

    // public array $productBoxCoordinates = [
    //     new Coordinate('a', 50, 150),
    //     new Coordinate('b', 150, 150),
    //     new Coordinate('c', 150, 50),
    //     new Coordinate('d', 50, 50),
    // ];


    public function testTextBoxIsInsideProductBox(): void
    {
        // Arrange
        $textBoxInside = new TextBox(
            [
                new Coordinate('a', 60, 80),
                new Coordinate('b', 80, 80),
                new Coordinate('c', 80, 60),
                new Coordinate('d', 60, 60),
            ]
        );

        $productBox = new ProductBox(
            [
                new Coordinate('a', 50, 150),
                new Coordinate('b', 150, 150),
                new Coordinate('c', 150, 50),
                new Coordinate('d', 50, 50),
            ]
        );

        $t = 8;

        $decisionMaker = new DecisionMaker();

        // Act
        $isInside = $decisionMaker->isInside($productBox, $textBoxInside);

        // Assert
        $this->assertTrue($isInside);
    }

    public function testTextBoxIsOutsideProductBox(): void
    {
        // Arrange
        $textBoxOutside = new TextBox(
            [
                new Coordinate('a', 170, 80),
                new Coordinate('b', 190, 80),
                new Coordinate('c', 190, 60),
                new Coordinate('d', 170, 60),
            ]
        );
        $productBox = new ProductBox(
            [
                new Coordinate('a', 50, 150),
                new Coordinate('b', 150, 150),
                new Coordinate('c', 150, 50),
                new Coordinate('d', 50, 50),
            ]
        );
        $decisionMaker = new DecisionMaker();

        // Act
        $isInside = $decisionMaker->isInside($productBox, $textBoxOutside);

        // Assert
        $this->assertFalse($isInside);
    }

}