<?php

namespace GeoIO\Geometry\Exception;

class InvalidDimensionException extends \InvalidArgumentException implements ExceptionInterface
{
    public static function create($dimension)
    {
        return new self(sprintf(
            'Invalid dimension: %s',
            $dimension
        ));
    }
}
