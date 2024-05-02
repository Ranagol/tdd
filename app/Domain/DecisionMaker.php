<?php

namespace App\Domain;

class DecisionMaker
{

    /**
     * Decides whether a given TextBox is inside a given ProductBox.
     *
     * @param ProductBox    $productBox
     * @param TextBox       $textBox
     * @return boolean      true if the TextBox is inside the ProductBox, false otherwise
     */
    //TODO ANDOR: I do not need to make a unit test for this? I already covered this with the feature tests
    public function isInside(ProductBox $productBox, TextBox $textBox): bool
    {

        $isInsideA = $this->compareCoordinates('a', $productBox, $textBox);
        $isInsideB = $this->compareCoordinates('b', $productBox, $textBox);
        $isInsideC = $this->compareCoordinates('c', $productBox, $textBox);
        $isInsideD = $this->compareCoordinates('d', $productBox, $textBox);

        /**
         * this returns true, if all 4 text box coordinates are inside the product box, false if any 
         * of them is outside
         */
        return $isInsideA && $isInsideB && $isInsideC && $isInsideD;
    }

    /**
     * returns true, if the a coordinate is inside the product box.
     * returns false, if the a coordinate is outside the product box
     * 
     * We check for every 4 coordinate (named a, b, c, d) of the text box, their position in
     * comparison with the 4 coordinates of the product box. For every one of the 4 coordinates
     * we return true, if the following conditions are met:
     * 
     * coordinate a, value x of the TextBox must be > than coordinate a, value x of the ProductBox
     * coordinate a, value y of the TextBox must be < than coordinate a, value y of the ProductBox
     * 
     * coordinate b, value x of the TextBox must be < than coordinate b, value x of the ProductBox
     * coordinate b, value y of the TextBox must be < than coordinate b, value y of the ProductBox
     * 
     * coordinate c, value x of the TextBox must be < than coordinate c, value x of the ProductBox
     * coordinate c, value y of the TextBox must be > than coordinate c, value y of the ProductBox
     * 
     * coordinate d, value x of the TextBox must be > than coordinate d, value x of the ProductBox
     * coordinate d, value y of the TextBox must be > than coordinate d, value y of the ProductBox
     *
     * @param string $coordinateName    // a or b or c or d
     * @param ProductBox $productBox
     * @param TextBox $textBox
     * @return boolean
     */
    //TODO ANDOR: I do not need to make a unit test for this, because this is a private method?
    private function compareCoordinates(
        string $coordinateName, 
        ProductBox $productBox,
        TextBox $textBox
    ): bool
    {
        //get one coordinate (a or b or c or d) from textBox AND from productBox
        $textBoxCoordinate = $textBox->getCoordinateByName($coordinateName);
        $productBoxCoordinate = $productBox->getCoordinateByName($coordinateName);

        //get x and y for one coordinate, for textBox and productBox too
        $xTextBox = $textBoxCoordinate->getX();
        $xProductBox = $productBoxCoordinate->getX();
        $yTextBox = $textBoxCoordinate->getY();
        $yProductBox = $productBoxCoordinate->getY();

        switch ($coordinateName) {
            case 'a':
                return ($xTextBox > $xProductBox && $yTextBox < $yProductBox) ? true : false;
                break;
        
            case 'b':
                return ($xTextBox < $xProductBox && $yTextBox < $yProductBox) ? true : false;
                break;
        
            case 'c':
                return ($xTextBox < $xProductBox && $yTextBox > $yProductBox) ? true : false;
                break;
        
            case 'd':
                return ($xTextBox > $xProductBox && $yTextBox > $yProductBox) ? true : false;
                break;
        
            default:
                return false;
                break;
        }
    }
}