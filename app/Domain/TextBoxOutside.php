<?php

namespace App\Domain;

use App\Domain\Coordinate;

/**
 * This represents a Coca Cola text box outside the ProductBox.
 */
class TextBoxOutside extends TextBox
{
    public function __construct()
    {
        $this->type = 'outside';
        $this->coordinates = [
            new Coordinate('a', 170, 80),
            new Coordinate('b', 190, 80),
            new Coordinate('c', 190, 60),
            new Coordinate('d', 170, 60),
        ];
    }
}