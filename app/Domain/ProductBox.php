<?php

namespace App\Domain;

/**
 * This represents a product box. Example: the can/tin of the Coca Cola product with the Coca Cola
 * text on it.
 */
class ProductBox extends Box
{
    protected string $type = 'productBox';
}