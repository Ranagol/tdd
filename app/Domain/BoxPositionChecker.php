<?php

namespace App\Domain;

class BoxPositionChecker
{
    /**
     * Decides whether a given TextBox is inside a given ProductBox.
     *
     * We check for every 4 coordinate (named a, b, c, d) of the text box, their position in
     * comparison with the 4 coordinates of the product box. 
     *
     * @param ProductBox    $productBox
     * @param TextBox       $textBox
     * @return boolean      true if the TextBox is inside the ProductBox, false otherwise
     */
    public function isTextBoxInsideProductBox(ProductBox $productBox, TextBox $textBox): bool
    {
        $isInsideA = $this->compareCoordinateA(
            $textBox->getCoordinateA()->getX(),
            $productBox->getCoordinateA()->getX(),
            $textBox->getCoordinateA()->getY(),
            $productBox->getCoordinateA()->getY()
        );

        $isInsideB = $this->compareCoordinateB(
            $textBox->getCoordinateB()->getX(),
            $productBox->getCoordinateB()->getX(),
            $textBox->getCoordinateB()->getY(),
            $productBox->getCoordinateB()->getY()
        );

        $isInsideC = $this->compareCoordinateC(
            $textBox->getCoordinateC()->getX(),
            $productBox->getCoordinateC()->getX(),
            $textBox->getCoordinateC()->getY(),
            $productBox->getCoordinateC()->getY()
        );

        $isInsideD = $this->compareCoordinateD(
            $textBox->getCoordinateD()->getX(),
            $productBox->getCoordinateD()->getX(),
            $textBox->getCoordinateD()->getY(),
            $productBox->getCoordinateD()->getY()
        );

        /**
         * this returns true, if all 4 text box coordinates are inside the product box, false if any 
         * of them is outside
         */
        return $isInsideA && $isInsideB && $isInsideC && $isInsideD;
    }

    /**
     * coordinate a, value x of the TextBox must be > than coordinate a, value x of the ProductBox
     * coordinate a, value y of the TextBox must be < than coordinate a, value y of the ProductBox
     * 
     * @param int $xTextBox
     * @param int $xProductBox
     * @param int $yTextBox
     * @param int $yProductBox
     * @return boolean
     */
    private function compareCoordinateA($xTextBox, $xProductBox, $yTextBox, $yProductBox): bool
    {
        return ($xTextBox >= $xProductBox && $yTextBox <= $yProductBox) ? true : false;
    }

    /**
     * coordinate b, value x of the TextBox must be < than coordinate b, value x of the ProductBox
     * coordinate b, value y of the TextBox must be < than coordinate b, value y of the ProductBox
     * 
     * @param int $xTextBox
     * @param int $xProductBox
     * @param int $yTextBox
     * @param int $yProductBox
     * @return boolean
     */
    private function compareCoordinateB($xTextBox, $xProductBox, $yTextBox, $yProductBox): bool
    {
        return ($xTextBox <= $xProductBox && $yTextBox <= $yProductBox) ? true : false;
    }

    /**
     * coordinate c, value x of the TextBox must be < than coordinate c, value x of the ProductBox
     * coordinate c, value y of the TextBox must be > than coordinate c, value y of the ProductBox
     * 
     * @param int $xTextBox
     * @param int $xProductBox
     * @param int $yTextBox
     * @param int $yProductBox
     * @return boolean
     */
    private function compareCoordinateC($xTextBox, $xProductBox, $yTextBox, $yProductBox): bool
    {
        return ($xTextBox <= $xProductBox && $yTextBox >= $yProductBox) ? true : false;
    }

    /**
     * coordinate d, value x of the TextBox must be > than coordinate d, value x of the ProductBox
     * coordinate d, value y of the TextBox must be > than coordinate d, value y of the ProductBox
     *
     * @param int $xTextBox
     * @param int $xProductBox
     * @param int $yTextBox
     * @param int $yProductBox
     * @return boolean
     */
    private function compareCoordinateD($xTextBox, $xProductBox, $yTextBox, $yProductBox): bool
    {
        return ($xTextBox >= $xProductBox && $yTextBox >= $yProductBox) ? true : false;
    }
}
